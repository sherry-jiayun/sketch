import { DB } from "./db";

export class User {
    private db:DB;

    constructor (db:DB) {
        this.db = db;
    }

    public isAdmin () : boolean {
        // fixme:
        return true;
    }

    public hasSigned () : boolean {
        // fixme:
        return false;
    }
}