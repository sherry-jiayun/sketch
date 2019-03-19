<?php

namespace Tests\Feature;

use Tests\TestCase;
use DB;

class MessageTest extends TestCase
{
    private function create_sender($message_limit)
    {
        $user = factory('App\Models\User')->create();
        $info = \App\Models\UserInfo::create([
            'user_id' => $user->id,
            'message_limit' => $message_limit,
        ]);
        return $user;
    }
    private function create_receiver($no_stranger_message)
    {
        $user = factory('App\Models\User')->create();
        $info = \App\Models\UserInfo::create([
            'user_id' => $user->id,
            'no_stranger_message' => $no_stranger_message,
        ]);
        return $user;
    }
    /** @test */
    public function an_authorised_user_can_send_message()//登陆用户可发私信
    {
        $poster = $this->create_sender(1);
        $receiver = $this->create_receiver(false);
        $this->actingAs($poster, 'api');
        $body = 'send this message';
        $response = $this->post('/api/message', ['sendTo' => $receiver->id, 'body' => $body])
        ->assertStatus(200)
        ->assertJsonStructure([
            'code',
            'data' => [
                'message' => [
                    'type',
                    'id',
                    'attributes' => [
                        'poster_id',
                        'receiver_id',
                        'message_body',
                        'created_at',
                    ],

                ]
            ],
        ])
        ->assertJson([
            'code' => 200,
            'data' => [
                'message' => [
                    'type' => 'message',
                    'attributes' => [
                        'poster_id' => $poster->id,
                        'receiver_id' => $receiver->id,
                        'message_body' => [
                            'body' => $body,
                        ],
                    ],
                ]
            ],
        ]);
        $this->assertEquals(0, $poster->info->message_limit);
    }

    /** @test */
    public function a_guest_can_not_send_message()//游客不可发私信
    {
        $receiver = $this->create_receiver(false);
        $body = 'send this message';

        $response = $this->post('/api/message', ['sendTo' => $receiver->id, 'body' => $body])->assertStatus(401);
    }

    /** @test */
    public function an_authorised_user_has_no_message_limit_can_not_send_message()//没有message_limit的用户不可发私信
    {
        $poster = $this->create_sender(0);
        $receiver = $this->create_receiver(false);
        $this->actingAs($poster, 'api');
        $body = 'send this message';

        $response = $this->post('/api/message', ['sendTo' => $receiver->id, 'body' => $body])->assertStatus(403);
    }

    /** @test */
    public function can_not_send_message_to_the_user_who_set_no_stranger_message()//不可发私信给设置了no_stranger_message的用户
    {
        $poster = $this->create_sender(1);
        $receiver = $this->create_receiver(true);
        $this->actingAs($poster, 'api');
        $body = 'send this message';

        $response = $this->post('/api/message', ['sendTo' => $receiver->id, 'body' => $body])->assertStatus(403);
    }

    /** @test */
    public function user_can_not_send_message_to_himself()//用户不可以给自己发私信
    {
        $poster = $this->create_sender(1);
        $this->actingAs($poster, 'api');
        $body = 'send this message';

        $response = $this->post('/api/message', ['sendTo' => $poster->id, 'body' => $body])->assertStatus(403);
    }

    /** @test */
    public function admin_can_send_mass_messages()//管理员可以群发私信
    {
        $admin = $this->create_sender(1);
        DB::table('role_user')->insert([
            'user_id' => $admin->id,
            'role' => 'admin',
        ]);
        $this->actingAs($admin, 'api');

        $receivers_id = [$this->create_receiver(false)->id, $this->create_receiver(false)->id];
        $body = 'send this message';

        $response = $this->post('/api/sendmessages', ['sendTos' => $receivers_id, 'body' => $body])
        ->assertStatus(200)
        ->assertJsonStructure([
            'code',
            'data' => [
                'messages' => [[
                    'type',
                    'id',
                    'attributes' => [
                        'poster_id',
                        'receiver_id',
                        'message_body',
                        'created_at',
                    ],
                ]]
            ],
        ])
        ->assertJson([
            'code' => 200,
            'data' => [
                'messages' => [[
                    'type' => 'message',
                    'attributes' => [
                        'poster_id' => $admin->id,
                        'receiver_id' => $receivers_id[0],
                        'message_body' => [
                            'body' => $body,
                        ],
                    ],
                ],[
                    'type' => 'message',
                    'attributes' => [
                        'poster_id' => $admin->id,
                        'receiver_id' => $receivers_id[1],
                        'message_body' => [
                            'body' => $body,
                        ],
                    ],
                ]]
            ],
        ]);
    }

    /** @test */
    public function admin_can_not_send_mass_messages_to_inexistent_user()//管理员不可以给不存在的用户发私信
    {
        $admin = $this->create_sender(1);
        DB::table('role_user')->insert([
            'user_id' => $admin->id,
            'role' => 'admin',
        ]);
        $this->actingAs($admin, 'api');

        $receivers_id = [99999, $this->create_receiver(false)->id];
        $body = 'send this message';

        $response = $this->post('/api/sendmessages', ['sendTos' => $receivers_id, 'body' => $body])
        ->assertStatus(404);
    }

    /** @test */
    public function user_can_not_send_mass_messages()//普通用户不可以群发私信
    {
        $user = $this->create_sender(2);
        $this->actingAs($user, 'api');

        $receivers_id = [$this->create_receiver(false)->id, $this->create_receiver(false)->id];
        $body = 'send this message';

        $response = $this->post('/api/sendmessages', ['sendTos' => $receivers_id, 'body' => $body])
        ->assertStatus(403);
    }

    /** @test */
    public function guest_can_not_send_mass_messages()//游客不可以群发私信
    {
        $receivers_id = [$this->create_receiver(false)->id, $this->create_receiver(false)->id];
        $body = 'send this message';

        $response = $this->post('/api/sendmessages', ['sendTos' => $receivers_id, 'body' => $body])
        ->assertStatus(401);
    }

    /** @test */
    public function an_authorised_user_can_check_messages_received()//登陆用户可查看已收私信
    {
        $poster = $this->create_sender(1);
        $receiver = $this->create_receiver(false);
        $this->actingAs($poster, 'api');
        $body = 'send this message';
        $this->post('/api/message', ['sendTo' => $receiver->id, 'body' => $body]);
        $this->actingAs($receiver, 'api');
        $response = $this->get('/api/user/'.$receiver->id.'/message?withStyle=receivebox')
        ->assertStatus(200)
        ->assertJsonStructure([
            'code',
            'data' => [
                'messages' => [
                    [
                        'type',
                        'id',
                        'attributes' => [
                            'message_body',
                        ],
                        'poster',
                        'receiver',
                    ]
                ],
            ],
        ])
        ->assertJson([
            'code' => 200,
            'data' => [
                'style' => 'receivebox',
                'messages' =>    [
                    [
                        'type' => 'message',
                        'attributes' => [
                            'poster_id' => $poster->id,
                            'receiver_id' => $receiver->id,
                            'message_body' => [
                                'body' => $body,
                            ],
                            'seen' => false,
                        ],
                    ]
                ],
            ],
        ]);
    }

    /** @test */
    public function administrator_can_check_all_messages_received()//管理员可查看用户已收私信
    {
        $poster = $this->create_sender(1);
        $receiver = $this->create_receiver(false);
        $this->actingAs($poster, 'api');
        $body = 'send this message';
        $this->post('/api/message', ['sendTo' => $receiver->id, 'body' => $body]);

        $admin = $this->create_sender(1);
        DB::table('role_user')->insert([
            'user_id' => $admin->id,
            'role' => 'admin',
        ]);
        $this->actingAs($admin, 'api');

        $response = $this->get('/api/user/'.$receiver->id.'/message?withStyle=receivebox')
        ->assertStatus(200)
        ->assertJson([
            'code' => 200,
            'data' => [
                'style' => 'receivebox',
                'messages' => [
                    [
                        'type' => 'message',
                        'attributes' => [
                            'poster_id' => $poster->id,
                            'receiver_id' => $receiver->id,
                            'message_body' => [
                                'body' => $body,
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }

    /** @test */
    public function a_guest_user_can_not_check_messages_received()//游客不可查看已收私信
    {
        $poster = $this->create_sender(1);

        $response = $this->get('/api/user/'.$poster->id.'/message?withStyle=receivebox')->assertStatus(401);
    }

    /** @test */
    public function an_authorised_user_can_check_messages_sent()//登陆用户可查看已发私信
    {
        $poster = $this->create_sender(1);
        $receiver = $this->create_receiver(false);
        $this->actingAs($poster, 'api');
        $body = 'send this message';
        $this->post('/api/message', ['sendTo' => $receiver->id, 'body' => $body]);

        $response = $this->get('/api/user/'.$poster->id.'/message?withStyle=sendbox')
        ->assertStatus(200)
        ->assertJson([
            'code' => 200,
            'data' => [
                'style' => 'sendbox',
                'messages' => [[
                    'type' => 'message',
                    'attributes' => [
                        'poster_id' => $poster->id,
                        'receiver_id' => $receiver->id,
                        'message_body' => [
                            'body' => $body,
                        ],
                    ],
                ],],
            ],
        ]);
    }

    /** @test */
    public function administrator_can_check_all_message_sent()//管理员可查看用户已发私信
    {
        $poster = $this->create_sender(1);
        $receiver = $this->create_receiver(false);
        $this->actingAs($poster, 'api');
        $body = 'send this message';
        $this->post('/api/message', ['sendTo' => $receiver->id, 'body' => $body]);

        $admin = $this->create_sender(1);
        DB::table('role_user')->insert([
            'user_id' => $admin->id,
            'role' => 'admin',
        ]);
        $this->actingAs($admin, 'api');

        $response = $this->get('/api/user/'.$poster->id.'/message?withStyle=sendbox')
        ->assertStatus(200)
        ->assertJson([
            'code' => 200,
            'data' => [
                'messages' => [[
                    'attributes' => [
                        'message_body' => [
                            'body' => $body,
                        ],
                    ],
                ],],
            ],
        ]);
    }

    /** @test */
    public function a_guest_user_can_not_check_messages_sent()//游客不可查看已发私信
    {
        $poster = $this->create_sender(1);

        $response = $this->get('/api/user/'.$poster->id.'/message?withStyle=sendbox')->assertStatus(401);
    }

    /** @test */
    public function an_authorised_user_can_check_dialogue()//登陆用户可查看与另一用户的对话
    {
        $poster = $this->create_sender(1);
        $receiver = $this->create_sender(1);

        $this->actingAs($poster, 'api');
        $body1 = 'send this message1';
        $this->post('/api/message', ['sendTo' => $receiver->id, 'body' => $body1]);

        $this->actingAs($receiver, 'api');
        $body2 = 'send this message2';
        $this->post('/api/message', ['sendTo' => $poster->id, 'body' => $body2]);

        $this->actingAs($poster, 'api');

        $response = $this->get('/api/user/'.$poster->id.'/message?withStyle=dialogue&chatWith='.$receiver->id)
        ->assertStatus(200);
    }

    /** @test */
    public function a_guest_user_can_not_check_dialogue()//游客不可查看对话
    {
        $user = factory('App\Models\User')->create();
        $chatWith = factory('App\Models\User')->create();

        $response = $this->get('/api/user/'.$user->id.'/message?withStyle=dialogue&chatWith='.$chatWith->id)->assertStatus(401);
    }
}
