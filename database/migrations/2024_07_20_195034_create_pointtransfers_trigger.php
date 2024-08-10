<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE TRIGGER pointtransfers_afc
            AFTER INSERT ON points_transfers FOR EACH ROW
            BEGIN
                INSERT INTO point_transfer_histories(points_transfers_id,user_id,accounttype,points,created_at,updated_at)
                VALUE(NEW.id,NEW.sender_id,'credit',NEW.points,NOW(),NOW());

                INSERT INTO point_transfer_histories(points_transfers_id,user_id,accounttype,points,created_at,updated_at)
                VALUE(NEW.id,NEW.receiver_id,'debit',NEW.points,NOW(),NOW());
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS pointtransfers_afc");
    }
};


// php artisan make:migration create_pointtransfers_trigger
