<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = User::create([
            'user_name' => 'Admin',
            'email' => 'admin@madmountain.pl',
            'password' => \Hash::make('5G4sd8qLVbknQLa9')
        ]);

        $user->assignRole('admin');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        User::whereName('Admin')->firstOrFail()->delete();
    }
}
