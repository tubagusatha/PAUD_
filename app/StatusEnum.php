<?php

namespace App;

enum StatusEnum: int {
    case PENGAJUAN_OLEH_PEMOHON = 1;
    case DITERIMA_OLEH_FRONT_OFFICE = 2;
    // Tambahkan nilai enum lainnya sesuai kebutuhan
}
