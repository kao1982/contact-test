<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            //  id / bigint unsigned / PRIMARY KEY はこれ1行で自動作成されます
            $table->id();
            
            //  category_id / bigint unsigned / FOREIGN KEY (categoriesテーブルのidと紐付け)
            // マイグレーションの実行順エラーを防ぐため、今回は一番シンプルなこの書き方にします！
            $table->unsignedBigInteger('category_id');
            
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->tinyInteger('gender'); // 1:男性 2:女性 3:その他
            $table->string('email', 255);
            $table->string('tel', 255);
            $table->string('address', 255);
            $table->string('building', 255)->nullable(); // 空っぽ(NULL)でもOKにする設定
            $table->text('detail');
            
            //  created_at / updated_at (timestamp) はこれ1行で自動作成されます
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
