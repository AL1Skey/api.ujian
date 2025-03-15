# API Documentation

## Auth

-   ### Login
    **Method**:POST
    **URL**:/admin/login
    **Body**:

    ```json
    {
        "username": "username",

        "password": "password"
    }
    ```

    **Response**:

    ```json
    {
        "guru": {
            "id": 1,
            "username": "username",
            "nama": "nama",
            "alamat": "alamat",
            "mapel_id": null,
            "is_active": 1,
            "agama_id": null,
            "created_at": "2025-03-05T08:35:38.000000Z",
            "updated_at": "2025-03-05T08:35:38.000000Z"
        },
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJ1c2VybmFtZSIsIm5hbWEiOiJuYW1hIiwiYWxhbWF0IjoiYWxhbWF0IiwibWFwZWxfaWQiOm51bGwsImlzX2FjdGl2ZSI6MSwiYWdhbWFfaWQiOm51bGwsImNyZWF0ZWRfYXQiOiIyMDI1LTAzLTA1VDA4OjM1OjM4LjAwMDAwMFoiLCJ1cGRhdGVkX2F0IjoiMjAyNS0wMy0wNVQwODozNTozOC4wMDAwMDBaIiwicGFzc3dvcmQiOiJwYXNzd29yZCIsImlhdCI6MTc0MjAwNjg5MiwiZXhwIjoxNzQyMDEwNDkyfQ.wkpqMluqXlH7xgimpbPFA-TxPvPKQ5Vn0ghQgvoHPp8"
    }
    ```

-   ### Register
    **Method**:POST
    **URL**:/admin/register
    **Body**:

    ```json
    {
        "username": "username",
        "password": "password",
        "nama": "nama",
        "alamat": "alamat"
    }
    ```

    **Response**:

    ```json
    {
        "guru": {
            "username": "username1",
            "nama": "nama",
            "alamat": "alamat",
            "updated_at": "2025-03-15T02:51:27.000000Z",
            "created_at": "2025-03-15T02:51:27.000000Z",
            "id": 2
        }
    }
    ```

## Admin

-   ### Agama
    **Method**:POST
    **URL**:/admin/agama
    **Body**:
    ```json
    {
        "nama": "Budha"
    }
    ```
    **Response**:
    ```json
    {
    "nama": "Budha",
    "updated_at": "2025-03-15T03:00:30.000000Z",
    "created_at": "2025-03-15T03:00:30.000000Z",
    "id": 2
    }
    ```

    **Method**:GET
    **URL**:/admin/agama
    **Response**:
    ```json
    {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "nama": "Hindu",
                "created_at": "2025-03-05T08:36:54.000000Z",
                "updated_at": "2025-03-05T08:36:54.000000Z"
            },
            {
                "id": 2,
                "nama": "Budha",
                "created_at": "2025-03-15T03:00:30.000000Z",
                "updated_at": "2025-03-15T03:00:30.000000Z"
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/admin/agama?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/api/admin/agama?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/admin/agama?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://127.0.0.1:8000/api/admin/agama",
        "per_page": 10,
        "prev_page_url": null,
        "to": 2,
        "total": 2
    }
    ```

    **Method**:PUT
    **URL**:/admin/agama/{id}
    **Body**:
    ```json
    {
        "nama": "Kong Hu Cu"
    }
    ```
    **Response**:
    ```json
    {
    "nama": "Kong Hu Cu",
    "updated_at": "2025-03-15T03:00:30.000000Z",
    "created_at": "2025-03-15T03:00:30.000000Z",
    "id": 2
    }
    ```

    **Method**:DELETE
    **URL**:/admin/agama/{id}
    **Body**:
    ```json
    {
        "nama": "Budha"
    }
    ```
    **Response**:
    ```json
    {
    "message": "Data deleted"
    }
    ```

-   ### Jurusan
    **Method**:POST
    **URL**:/admin/jurusan
    **Body**:
    ```json
    {
        "nama": "Cyber"
    }
    ```
    **Response**:
    ```json
    {
    "nama": "Cyber",
    "updated_at": "2025-03-15T03:00:30.000000Z",
    "created_at": "2025-03-15T03:00:30.000000Z",
    "id": 2
    }
    ```

    **Method**:GET
    **URL**:/admin/jurusan
    **Response**:
    ```json
    {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "nama": "Cyber",
                "created_at": "2025-03-05T08:36:54.000000Z",
                "updated_at": "2025-03-05T08:36:54.000000Z"
            },
            {
                "id": 2,
                "nama": "Cyber1",
                "created_at": "2025-03-15T03:00:30.000000Z",
                "updated_at": "2025-03-15T03:00:30.000000Z"
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/admin/jurusan?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/api/admin/jurusan?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/admin/jurusan?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://127.0.0.1:8000/api/admin/jurusan",
        "per_page": 10,
        "prev_page_url": null,
        "to": 2,
        "total": 2
    }
    ```

    **Method**:PUT
    **URL**:/admin/jurusan/{id}
    **Body**:
    ```json
    {
        "nama": "IPA"
    }
    ```
    **Response**:
    ```json
    {
    "nama": "IPA",
    "updated_at": "2025-03-15T03:00:30.000000Z",
    "created_at": "2025-03-15T03:00:30.000000Z",
    "id": 2
    }
    ```

    **Method**:DELETE
    **URL**:/admin/jurusan/{id}
    **Body**:
    ```json
    {
        "nama": "Budha"
    }
    ```
    **Response**:
    ```json
    {
    "message": "Data deleted"
    }
    ```

-   ### Mapel
    **Method**:POST
    **URL**:/admin/mapel
    **Body**:
    ```json
    {
        "nama": "Cyber"
    }
    ```
    **Response**:
    ```json
    {
    "nama": "Cyber",
    "updated_at": "2025-03-15T03:00:30.000000Z",
    "created_at": "2025-03-15T03:00:30.000000Z",
    "id": 2
    }
    ```

    **Method**:GET
    **URL**:/admin/mapel
    **Response**:
    ```json
    {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "nama": "Cyber",
                "created_at": "2025-03-05T08:36:54.000000Z",
                "updated_at": "2025-03-05T08:36:54.000000Z"
            },
            {
                "id": 2,
                "nama": "Cyber1",
                "created_at": "2025-03-15T03:00:30.000000Z",
                "updated_at": "2025-03-15T03:00:30.000000Z"
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/admin/mapel?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/api/admin/mapel?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/admin/mapel?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://127.0.0.1:8000/api/admin/mapel",
        "per_page": 10,
        "prev_page_url": null,
        "to": 2,
        "total": 2
    }
    ```

    **Method**:PUT
    **URL**:/admin/mapel/{id}
    **Body**:
    ```json
    {
        "nama": "IPA"
    }
    ```
    **Response**:
    ```json
    {
        "nama": "IPA",
        "updated_at": "2025-03-15T03:00:30.000000Z",
        "created_at": "2025-03-15T03:00:30.000000Z",
        "id": 2
    }
    ```

    **Method**:DELETE
    **URL**:/admin/mapel/{id}
    **Response**:
    ```json
    {
        "message": "Data deleted"
    }
    ```

-   ### Kelompok Ujian
    **Method**:POST
    **URL**:/admin/kelompok_ujian
    **Body**:
    ```json
    {
        "nama":"Ujian Tengah Semestar",
        "id_sekolah":"A123456",
        "start_date":"26-11-2025",
        "end_date":"2-12-2025"
    }
    ```
    **Response**:
    ```json
    {
        "nama": "Ujian Tengah Semestar",
        "id_sekolah": "A123456",
        "start_date": "26-11-2025",
        "end_date": "2-12-2025",
        "updated_at": "2025-03-15T03:20:32.000000Z",
        "created_at": "2025-03-15T03:20:32.000000Z",
        "id": 2
    }
    ```

    **Method**:GET
    **URL**:/admin/kelompok_ujian
    **Response**:
    ```json
    {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "nama": "Ujian Tengah Semestar",
                "id_sekolah": "A123456",
                "start_date": "26-11-2025",
                "end_date": "2-12-2025",
                "created_at": "2025-03-05T08:36:54.000000Z",
                "updated_at": "2025-03-05T08:36:54.000000Z"
            },
            {
                "id": 2,
                "nama": "Ujian Tengah Semestar",
                "id_sekolah": "A123456",
                "start_date": "26-11-2025",
                "end_date": "2-12-2025",
                "created_at": "2025-03-15T03:00:30.000000Z",
                "updated_at": "2025-03-15T03:00:30.000000Z"
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/admin/kelompok_ujian?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/api/admin/kelompok_ujian?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/admin/kelompok_ujian?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://127.0.0.1:8000/api/admin/kelompok_ujian",
        "per_page": 10,
        "prev_page_url": null,
        "to": 2,
        "total": 2
    }
    ```

    **Method**:PUT
    **URL**:/admin/kelompok_ujian/{id}
    **Body**:
    ```json
    {
        "nama":"Ujian Akhir Semestar",
        "id_sekolah":"A123456",
        "start_date":"26-11-2025",
        "end_date":"2-12-2025"
    }
    ```
    **Response**:
    ```json
    {
        "nama":"Ujian Akhir Semestar",
        "id_sekolah":"A123456",
        "start_date":"26-11-2025",
        "end_date":"2-12-2025",
        "updated_at": "2025-03-15T03:00:30.000000Z",
        "created_at": "2025-03-15T03:00:30.000000Z",
        "id": 2
    }
    ```

    **Method**:DELETE
    **URL**:/admin/kelompok_ujian/{id}
    **Response**:
    ```json
    {
        "message": "Data deleted"
    }
    ```


-   ### Daftar Kelas
    **Method**:POST
    **URL**:/admin/daftar_kelas
    **Body**:
    ```json
    {
        "nama":"VII"
    }
    ```
    **Response**:
    ```json
    {
        "nama":"VII",
        "updated_at": "2025-03-15T03:20:32.000000Z",
        "created_at": "2025-03-15T03:20:32.000000Z",
        "id": 2
    }
    ```

    **Method**:GET
    **URL**:/admin/daftar_kelas
    **Response**:
    ```json
    {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "nama":"VII",
                "created_at": "2025-03-05T08:36:54.000000Z",
                "updated_at": "2025-03-05T08:36:54.000000Z"
            },
            {
                "id": 2,
                "nama":"VII",
                "created_at": "2025-03-15T03:00:30.000000Z",
                "updated_at": "2025-03-15T03:00:30.000000Z"
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/admin/daftar_kelas?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/api/admin/daftar_kelas?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/admin/daftar_kelas?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://127.0.0.1:8000/api/admin/daftar_kelas",
        "per_page": 10,
        "prev_page_url": null,
        "to": 2,
        "total": 2
    }
    ```

    **Method**:PUT
    **URL**:/admin/daftar_kelas/{id}
    **Body**:
    ```json
    {
        "nama":"VII"
    }
    ```
    **Response**:
    ```json
    {
        "nama":"VII",
        "updated_at": "2025-03-15T03:00:30.000000Z",
        "created_at": "2025-03-15T03:00:30.000000Z",
        "id": 2
    }
    ```

    **Method**:DELETE
    **URL**:/admin/daftar_kelas/{id}
    **Response**:
    ```json
    {
        "message": "Data deleted"
    }
    ```

-   ### Ujian
    **Method**:POST
    **URL**:/admin/ujian
    **Body**:
    ```json
    {
        "kelompok_id": "1",
        "mapel_id": "1",
        "kelas_id": "1",
        "nama": "required|string",
        "id_sekolah": "1",
        "start_date": "20-2-2025",
        "end_date": "20-2-2025",
        "status": "1"
    }
    ```
    **Response**:
    ```json
    {
        "kelompok_id": "1",
        "mapel_id": "1",
        "kelas_id": "1",
        "nama": "required|string",
        "id_sekolah": "1",
        "start_date": "20-2-2025",
        "end_date": "20-2-2025",
        "status": "1",
        "updated_at": "2025-03-15T03:28:51.000000Z",
        "created_at": "2025-03-15T03:28:51.000000Z",
        "id": 2
    }
    ```

    **Method**:GET
    **URL**:/admin/ujian
    **Response**:
    ```json
    {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "kelompok_id": 1,
                "mapel_id": 1,
                "kelas_id": 1,
                "nama": "required|string",
                "id_sekolah": "1",
                "start_date": "20-2-2025",
                "end_date": "20-2-2025",
                "status": 1,
                "created_at": "2025-03-05T08:37:33.000000Z",
                "updated_at": "2025-03-05T08:37:33.000000Z",
                "kelompok_ujian": {
                    "id": 1,
                    "nama": "Ujian Tengah Semestar",
                    "id_sekolah": "A123456",
                    "start_date": "26-11-2025",
                    "end_date": "2-12-2025",
                    "created_at": "2025-03-05T08:37:15.000000Z",
                    "updated_at": "2025-03-05T08:37:15.000000Z"
                },
                "mapel": {
                    "id": 1,
                    "nama": "Kimia",
                    "created_at": "2025-03-05T08:37:04.000000Z",
                    "updated_at": "2025-03-05T08:37:04.000000Z"
                },
                "kelas": {
                    "id": 1,
                    "nama": "VII",
                    "created_at": "2025-03-05T08:37:26.000000Z",
                    "updated_at": "2025-03-05T08:37:26.000000Z"
                }
            },
            {
                "id": 2,
                "kelompok_id": 1,
                "mapel_id": 1,
                "kelas_id": 1,
                "nama": "required|string",
                "id_sekolah": "1",
                "start_date": "20-2-2025",
                "end_date": "20-2-2025",
                "status": 1,
                "created_at": "2025-03-15T03:28:51.000000Z",
                "updated_at": "2025-03-15T03:28:51.000000Z",
                "kelompok_ujian": {
                    "id": 1,
                    "nama": "Ujian Tengah Semestar",
                    "id_sekolah": "A123456",
                    "start_date": "26-11-2025",
                    "end_date": "2-12-2025",
                    "created_at": "2025-03-05T08:37:15.000000Z",
                    "updated_at": "2025-03-05T08:37:15.000000Z"
                },
                "mapel": {
                    "id": 1,
                    "nama": "Kimia",
                    "created_at": "2025-03-05T08:37:04.000000Z",
                    "updated_at": "2025-03-05T08:37:04.000000Z"
                },
                "kelas": {
                    "id": 1,
                    "nama": "VII",
                    "created_at": "2025-03-05T08:37:26.000000Z",
                    "updated_at": "2025-03-05T08:37:26.000000Z"
                }
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/admin/ujian?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/api/admin/ujian?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/admin/ujian?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://127.0.0.1:8000/api/admin/ujian",
        "per_page": 10,
        "prev_page_url": null,
        "to": 2,
        "total": 2
    }
    ```

    **Method**:PUT
    **URL**:/admin/ujian/{id}
    **Body**:
    ```json
    {
        "kelompok_id": "1",
        "mapel_id": "1",
        "kelas_id": "1",
        "nama": "Ujian Matematika",
        "id_sekolah": "1",
        "start_date": "20-3-2025",
        "end_date": "20-3-2025",
        "status": "1"
    }
    ```
    **Response**:
    ```json
    {
        "kelompok_id": "1",
        "mapel_id": "1",
        "kelas_id": "1",
        "nama": "Ujian Matematika",
        "id_sekolah": "1",
        "start_date": "20-3-2025",
        "end_date": "20-3-2025",
        "status": "1",
        "updated_at": "2025-03-15T03:00:30.000000Z",
        "created_at": "2025-03-15T03:00:30.000000Z",
        "id": 2
    }
    ```

    **Method**:DELETE
    **URL**:/admin/ujian/{id}
    **Response**:
    ```json
    {
        "message": "Data deleted"
    }
    ```

-   ### Soal
    **Method**:POST
    **URL**:/admin/soal
    **Body**:
    ```json
    {
    "ujian_id": 1,
    "soal": "Apa ibu kota Indonesia?",
    "tipe_soal": "pilihan_ganda",
    "pilihan_a": "Jakarta",
    "pilihan_b": "Bandung",
    "pilihan_c": "Surabaya",
    "pilihan_d": "Medan",
    "pilihan_e": "Makassar",
    "jawaban": "Jakarta"
    }
    ```
    **Response**:
    ```json
    {
        "ujian_id": 1,
        "soal": "Apa ibu kota Indonesia?",
        "tipe_soal": "pilihan_ganda",
        "pilihan_a": "Jakarta",
        "pilihan_b": "Bandung",
        "pilihan_c": "Surabaya",
        "pilihan_d": "Medan",
        "pilihan_e": "Makassar",
        "jawaban": "Jakarta",
        "updated_at": "2025-03-15T03:20:32.000000Z",
        "created_at": "2025-03-15T03:20:32.000000Z",
        "id": 2
    }
    ```

    **Method**:GET
    **URL**:/admin/soal
    **Response**:
    ```json
    {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "ujian_id": 1,
                "soal": "Jelaskan ibu kota Australia?",
                "tipe_soal": "essai",
                "pilihan_a": null,
                "pilihan_b": null,
                "pilihan_c": null,
                "pilihan_d": null,
                "pilihan_e": null,
                "jawaban": null,
                "created_at": "2025-03-05T08:48:44.000000Z",
                "updated_at": "2025-03-05T08:53:59.000000Z",
                "ujian": {
                    "id": 1,
                    "kelompok_id": 1,
                    "mapel_id": 1,
                    "kelas_id": 1,
                    "nama": "required|string",
                    "id_sekolah": "1",
                    "start_date": "20-2-2025",
                    "end_date": "20-2-2025",
                    "status": 1,
                    "created_at": "2025-03-05T08:37:33.000000Z",
                    "updated_at": "2025-03-05T08:37:33.000000Z",
                    "kelas": {
                        "id": 1,
                        "nama": "VII",
                        "created_at": "2025-03-05T08:37:26.000000Z",
                        "updated_at": "2025-03-05T08:37:26.000000Z"
                    },
                    "mapel": {
                        "id": 1,
                        "nama": "Kimia",
                        "created_at": "2025-03-05T08:37:04.000000Z",
                        "updated_at": "2025-03-05T08:37:04.000000Z"
                    },
                    "kelompok_ujian": {
                        "id": 1,
                        "nama": "Ujian Tengah Semestar",
                        "id_sekolah": "A123456",
                        "start_date": "26-11-2025",
                        "end_date": "2-12-2025",
                        "created_at": "2025-03-05T08:37:15.000000Z",
                        "updated_at": "2025-03-05T08:37:15.000000Z"
                    }
                }
            },
            {
                "id": 2,
                "ujian_id": 1,
                "soal": "Apa ibu kota Indonesia?",
                "tipe_soal": "pilihan_ganda",
                "pilihan_a": "Jakarta",
                "pilihan_b": "Bandung",
                "pilihan_c": "Surabaya",
                "pilihan_d": "Medan",
                "pilihan_e": "Makassar",
                "jawaban": "Jakarta",
                "created_at": "2025-03-15T03:34:21.000000Z",
                "updated_at": "2025-03-15T03:34:21.000000Z",
                "ujian": {
                    "id": 1,
                    "kelompok_id": 1,
                    "mapel_id": 1,
                    "kelas_id": 1,
                    "nama": "required|string",
                    "id_sekolah": "1",
                    "start_date": "20-2-2025",
                    "end_date": "20-2-2025",
                    "status": 1,
                    "created_at": "2025-03-05T08:37:33.000000Z",
                    "updated_at": "2025-03-05T08:37:33.000000Z",
                    "kelas": {
                        "id": 1,
                        "nama": "VII",
                        "created_at": "2025-03-05T08:37:26.000000Z",
                        "updated_at": "2025-03-05T08:37:26.000000Z"
                    },
                    "mapel": {
                        "id": 1,
                        "nama": "Kimia",
                        "created_at": "2025-03-05T08:37:04.000000Z",
                        "updated_at": "2025-03-05T08:37:04.000000Z"
                    },
                    "kelompok_ujian": {
                        "id": 1,
                        "nama": "Ujian Tengah Semestar",
                        "id_sekolah": "A123456",
                        "start_date": "26-11-2025",
                        "end_date": "2-12-2025",
                        "created_at": "2025-03-05T08:37:15.000000Z",
                        "updated_at": "2025-03-05T08:37:15.000000Z"
                    }
                }
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/admin/soal?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/api/admin/soal?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/admin/soal?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://127.0.0.1:8000/api/admin/soal",
        "per_page": 100,
        "prev_page_url": null,
        "to": 2,
        "total": 2
    }
    ```

    **Method**:PUT
    **URL**:/admin/soal/{id}
    **Body**:
    ```json
    {
    "ujian_id": 1,
    "soal": "Apa ibu kota Indonesia?",
    "tipe_soal": "essay",
    "pilihan_a": "",
    "pilihan_b": "",
    "pilihan_c": "",
    "pilihan_d": "",
    "pilihan_e": "",
    "jawaban": "Jakarta"
    }
    ```
    **Response**:
    ```json
    {
        "ujian_id": 1,
        "soal": "Apa ibu kota Indonesia?",
        "tipe_soal": "essay",
        "pilihan_a": "",
        "pilihan_b": "",
        "pilihan_c": "",
        "pilihan_d": "",
        "pilihan_e": "",
        "jawaban": "Jakarta",
        "updated_at": "2025-03-15T03:00:30.000000Z",
        "created_at": "2025-03-15T03:00:30.000000Z",
        "id": 2
    }
    ```

    **Method**:DELETE
    **URL**:/admin/soal/{id}
    **Response**:
    ```json
    {
        "message": "Data deleted"
    }
    ```

-   ### Sesi Ujian
    **Method**:POST
    **URL**:/admin/sesi_ujian
    **Body**:
    ```json
    {
        "ujian_id": "1",
        "nomor_peserta":"ABCDE113"
    }
    ```
    **Response**:
    ```json
    {
        "nama":"VII",
        "updated_at": "2025-03-15T03:20:32.000000Z",
        "created_at": "2025-03-15T03:20:32.000000Z",
        "id": 2
    }
    ```

    **Method**:GET
    **URL**:/admin/sesi_ujian
    **Response**:
    ```json
    {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "nama":"VII",
                "created_at": "2025-03-05T08:36:54.000000Z",
                "updated_at": "2025-03-05T08:36:54.000000Z"
            },
            {
                "id": 2,
                "nama":"VII",
                "created_at": "2025-03-15T03:00:30.000000Z",
                "updated_at": "2025-03-15T03:00:30.000000Z"
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/admin/sesi_ujian?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/api/admin/sesi_ujian?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/admin/sesi_ujian?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://127.0.0.1:8000/api/admin/sesi_ujian",
        "per_page": 10,
        "prev_page_url": null,
        "to": 2,
        "total": 2
    }
    ```

    **Method**:PUT
    **URL**:/admin/sesi_ujian/{id}
    **Body**:
    ```json
    {
        "nama":"VII"
    }
    ```
    **Response**:
    ```json
    {
        "nama":"VII",
        "updated_at": "2025-03-15T03:00:30.000000Z",
        "created_at": "2025-03-15T03:00:30.000000Z",
        "id": 2
    }
    ```

    **Method**:DELETE
    **URL**:/admin/sesi_ujian/{id}
    **Response**:
    ```json
    {
        "message": "Data deleted"
    }
    ```