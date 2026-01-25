<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_deployments', function (Blueprint $table) {
            $table->id();
            $table->integer('id_ihld')->nullable();
            $table->string('tematik')->nullable();
            $table->boolean('type_deployment')->nullable()->comment('PT2 / PT3');
            $table->integer('status_osm')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('sto')->nullable();
            $table->string('id_pid')->nullable();
            $table->string('id_sap')->nullable();
            $table->integer('jumlah_odp_drm')->nullable();
            $table->integer('jumlah_port_drm')->nullable();
            $table->integer('nilai_drm')->nullable();
            $table->integer('jumlah_odp_real')->nullable();
            $table->integer('jumlah_port_real')->nullable();
            $table->integer('nilai_perijinan')->nullable();
            $table->integer('nilai_material')->nullable();
            $table->integer('nilai_jasa')->nullable();
            $table->integer('status_fisik')->nullable();
            $table->integer('status_lapangan')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('id_sw')->nullable();
            $table->string('odp')->nullable();
            $table->string('mitra_id')->nullable();
            $table->date('komitment_perijinan')->nullable();
            $table->date('tanggal_perijinan')->nullable();
            $table->date('komitment_matdev')->nullable();
            $table->date('tanggal_matdev')->nullable();
            $table->date('komitment_instalasi')->nullable();
            $table->date('tanggal_instalasi')->nullable();
            $table->date('komitment_fi')->nullable();
            $table->date('tanggal_fi')->nullable();
            $table->date('komitment_gl')->nullable();
            $table->date('tanggal_gl')->nullable();
            $table->boolean('pembayaran_cc')->nullable()->comment('mitra / ta');
            $table->date('tanggal_eprop')->nullable();
            $table->string('batch')->nullable();
            $table->string('no_po')->nullable();
            $table->string('status_ihld')->nullable();
            $table->string('status_tomps')->nullable();
            $table->string('status_proyek')->nullable();
            $table->string('telkomsel_branch')->nullable();
            $table->string('ba_prelim')->nullable();
            $table->date('tanggal_nde')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_deployments');
    }
};
