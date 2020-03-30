<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Kolom :attribute harus disetujui.',
    'active_url'           => 'Kolom :attribute bukan URL yang valid.',
    'after'                => 'Kolom :attribute harus tanggal setelah :date.',
    'alpha'                => 'Kolom :attribute hanya boleh berisi huruf.',
    'alpha_dash'           => 'Kolom :attribute hanya boleh berisi huruf, nomor dan tanda -.',
    'alpha_num'            => 'Kolom :attribute hanya boleh berisi huruf, nomor.',
    'array'                => 'Kolom :attribute harus berupa array.',
    'before'               => 'Kolom :attribute harus tanggal sebelum :date.',
    'between'              => [
        'numeric' => 'Kolom :attribute harus antara :min dan :max.',
        'file'    => 'Kolom :attribute harus antara :min dan :max kilobyte.',
        'string'  => 'Kolom :attribute harus antara :min dan :max karakter.',
        'array'   => 'Kolom :attribute harus antara :min dan :max item.',
    ],
    'boolean'              => 'Kolom :attribute harus berisi true atau false.',
    'confirmed'            => 'Kolom :attribute kode konfirmasi tidak sesuai.',
    'date'                 => 'Kolom :attribute bukan merupakan tangal yang valid.',
    'date_format'          => 'Kolom :attribute tidak sesuai dengan format :format.',
    'different'            => 'Kolom :attribute dan :other harus berbeda.',
    'digits'               => 'Kolom :attribute harus berisi :digits digit.',
    'digits_between'       => 'Kolom :attribute harus antara :min dan :max digit.',
    'dimensions'           => 'Kolom :attribute memiliki dimensi yang salah.',
    'distinct'             => 'Kolom :attribute berisi duplikasi nilai.',
    'email'                => 'Kolom :attribute harus berisi alamat email yang valid.',
    'exists'               => 'Kolom terpilih :attribute tidak valid.',
    'file'                 => 'Kolom :attribute harus berisi file.',
    'filled'               => 'Kolom :attribute wajib diisi.',
    'image'                => 'Kolom :attribute harus berisi gambar.',
    'in'                   => 'Kolom terpilih :attribute tidak valid.',
    'in_array'             => 'Kolom :attribute tidak tersedia di :other.',
    'integer'              => 'Kolom :attribute harus berisi angka.',
    'ip'                   => 'Kolom :attribute harus berisi alamat IP yang valid.',
    'json'                 => 'Kolom :attribute harus berisi string JSON yang valid.',
    'max'                  => [
        'numeric' => 'Kolom :attribute tidak lebih besar dari :max.',
        'file'    => 'Kolom :attribute tidak lebih besar dari :max kilobyte.',
        'string'  => 'Kolom :attribute tidak lebih besar dari :max karakter.',
        'array'   => 'Kolom :attribute tidak lebih dari :max item.',
    ],
    'mimes'                => 'Kolom :attribute harus berisi file dengan tipe: :values.',
    'mimetypes'            => 'Kolom :attribute harus berisi file dengan tipe: :values.',
    'min'                  => [
        'numeric' => 'Kolom :attribute harus berisi minimal :min.',
        'file'    => 'Kolom :attribute harus berisi minimal :min kilobyte.',
        'string'  => 'Kolom :attribute harus berisi minimal :min karakter.',
        'array'   => 'Kolom :attribute harus berisi minimal :min item.',
    ],
    'not_in'               => 'Kolom terpilih :attribute tidak valid.',
    'numeric'              => 'Kolom :attribute harus berisi nomor.',
    'present'              => 'Kolom :attribute harus bernilai sekarang.',
    'regex'                => 'Format :attribute tidak valid.',
    'required'             => 'Kolom :attribute wajib diisi.',
    'required_if'          => 'Kolom :attribute wajib diisi pada saat :other sama dengan :value.',
    'required_unless'      => 'Kolom :attribute wajib diisi kecuali :other bernilai :values.',
    'required_with'        => 'Kolom :attribute wajib diisi pada saat :values tersedia.',
    'required_with_all'    => 'Kolom :attribute wajib diisi pada saat :values tersedia.',
    'required_without'     => 'Kolom :attribute wajib diisi pada saat :values tidak tersedia.',
    'required_without_all' => 'Kolom :attribute wajib diisi pada saat tidak satupun :values tersedia.',
    'same'                 => 'Kolom :attribute dan :other harus sama.',
    'size'                 => [
        'numeric' => 'Kolom :attribute harus berisi :size.',
        'file'    => 'Kolom :attribute harus berisi :size kilobyte.',
        'string'  => 'Kolom :attribute harus berisi :size karakter.',
        'array'   => 'Kolom :attribute harus berisi :size item.',
    ],
    'string'               => 'Kolom :attribute harus berisi teks.',
    'timezone'             => 'Kolom :attribute harus berisi zona yang valid.',
    'unique'               => 'Kolom :attribute telah dipakai.',
    'uploaded'             => 'Kolom :attribute gagal mengunggah.',
    'url'                  => 'Format :attribute salah.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
