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

-   ### Peserta
    **Method**:POST
    **URL**:/admin/peserta
    **Body**:
    ```json
    {
        "nama": "Adit",
        "password": "$2y$12$IxzMi11r2lW.sd/aRWkqj.0SVwE1/cO7BzzsNBtG..1CS8B3XF14u",
        "jurusan_id": "1",
        "agama_id": "1",
        "kelas_id": "1",
        "nomor_peserta": 161131,
    }
    ```
    **Response**:
    ```json
    {
        "nama": "Adit",
        "password": "$2y$12$IxzMi11r2lW.sd/aRWkqj.0SVwE1/cO7BzzsNBtG..1CS8B3XF14u",
        "jurusan_id": "1",
        "agama_id": "1",
        "kelas_id": "1",
        "nomor_peserta": 161131,
        "updated_at": "2025-03-15T04:34:16.000000Z",
        "created_at": "2025-03-15T04:34:16.000000Z",
        "id": 4
    }
    ```

    **Method**:GET
    **URL**:/admin/peserta
    **Response**:
    ```json
    {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "nomor_peserta": 70249488,
                "password": "AAAAAAAA",
                "remember_token": null,
                "nama": "Hindu",
                "alamat": null,
                "kelas_id": null,
                "jurusan_id": null,
                "agama_id": null,
                "created_at": "2025-03-15T04:21:31.000000Z",
                "updated_at": "2025-03-15T04:21:31.000000Z",
                "jurusan": null,
                "agama": null,
                "kelas": null
            },
            {
                "id": 2,
                "nomor_peserta": 990771,
                "password": "AAAAAAAA",
                "remember_token": null,
                "nama": "Budha",
                "alamat": null,
                "kelas_id": 1,
                "jurusan_id": 1,
                "agama_id": null,
                "created_at": "2025-03-15T04:26:03.000000Z",
                "updated_at": "2025-03-15T04:26:03.000000Z",
                "jurusan": {
                    "id": 1,
                    "nama": "Cyber",
                    "created_at": "2025-03-15T04:21:44.000000Z",
                    "updated_at": "2025-03-15T04:21:44.000000Z"
                },
                "agama": null,
                "kelas": {
                    "id": 1,
                    "nama": "VII",
                    "created_at": "2025-03-15T04:22:00.000000Z",
                    "updated_at": "2025-03-15T04:22:00.000000Z"
                }
            },
            {
                "id": 3,
                "nomor_peserta": 210425,
                "password": "AAAAAAAA",
                "remember_token": null,
                "nama": "Adit",
                "alamat": null,
                "kelas_id": 1,
                "jurusan_id": 1,
                "agama_id": 1,
                "created_at": "2025-03-15T04:26:59.000000Z",
                "updated_at": "2025-03-15T04:26:59.000000Z",
                "jurusan": {
                    "id": 1,
                    "nama": "Cyber",
                    "created_at": "2025-03-15T04:21:44.000000Z",
                    "updated_at": "2025-03-15T04:21:44.000000Z"
                },
                "agama": {
                    "id": 1,
                    "nama": "Budha",
                    "created_at": "2025-03-15T04:26:47.000000Z",
                    "updated_at": "2025-03-15T04:26:47.000000Z"
                },
                "kelas": {
                    "id": 1,
                    "nama": "VII",
                    "created_at": "2025-03-15T04:22:00.000000Z",
                    "updated_at": "2025-03-15T04:22:00.000000Z"
                }
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/admin/peserta?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/api/admin/peserta?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/admin/peserta?page=1",
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
        "path": "http://127.0.0.1:8000/api/admin/peserta",
        "per_page": 10,
        "prev_page_url": null,
        "to": 3,
        "total": 3
    }
    ```

    **Method**:PUT
    **URL**:/admin/peserta/{id}
    **Body**:
    ```json
    {
        "nama": "Budi",
        "password": "AAAAAA",
        "jurusan_id": "1",
        "agama_id": "1",
        "kelas_id": "1"
    }
    ```
    **Response**:
    ```json
    {
        "id": 1,
        "nomor_peserta": 70249488,
        "password": "$2y$12$XdYf1U9i5ll31/ygIT5r8.iYUF2fh4RyCef9jtd5d0GMhyTSHgTJa",
        "remember_token": null,
        "nama": "Budi",
        "alamat": null,
        "kelas_id": "1",
        "jurusan_id": "1",
        "agama_id": "1",
        "created_at": "2025-03-15T04:21:31.000000Z",
        "updated_at": "2025-03-15T04:43:49.000000Z"
    }
    ```

    **Method**:DELETE
    **URL**:/admin/peserta/{id}
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
        "nomor_peserta":"210425"
    }
    ```
    **Response**:
    ```json
    {
        "ujian_id": "1",
        "nomor_peserta": "210425",
        "updated_at": "2025-03-15T04:28:19.000000Z",
        "created_at": "2025-03-15T04:28:19.000000Z",
        "id": 1
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
                "ujian_id": 1,
                "nomor_peserta": 210425,
                "created_at": "2025-03-15T04:28:19.000000Z",
                "updated_at": "2025-03-15T04:28:19.000000Z",
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
                    "created_at": "2025-03-15T04:27:50.000000Z",
                    "updated_at": "2025-03-15T04:27:50.000000Z",
                    "kelas": {
                        "id": 1,
                        "nama": "VII",
                        "created_at": "2025-03-15T04:22:00.000000Z",
                        "updated_at": "2025-03-15T04:22:00.000000Z"
                    },
                    "mapel": {
                        "id": 1,
                        "nama": "Kimia",
                        "created_at": "2025-03-15T04:21:49.000000Z",
                        "updated_at": "2025-03-15T04:21:49.000000Z"
                    },
                    "kelompok_ujian": {
                        "id": 1,
                        "nama": "Ujian Tengah Semestar",
                        "id_sekolah": "A123456",
                        "start_date": "26-11-2025",
                        "end_date": "2-12-2025",
                        "created_at": "2025-03-15T04:21:54.000000Z",
                        "updated_at": "2025-03-15T04:21:54.000000Z"
                    }
                },
                "peserta": {
                    "id": 3,
                    "nomor_peserta": 210425,
                    "password": "AAAAAAAA",
                    "remember_token": null,
                    "nama": "Adit",
                    "alamat": null,
                    "kelas_id": 1,
                    "jurusan_id": 1,
                    "agama_id": 1,
                    "created_at": "2025-03-15T04:26:59.000000Z",
                    "updated_at": "2025-03-15T04:26:59.000000Z"
                }
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
        "to": 1,
        "total": 1
    }
    ```

    **Method**:PUT
    **URL**:/admin/sesi_ujian/{id}
    **Body**:
    ```json
    {
        "ujian_id": "1",
        "nomor_peserta":"990771"
    }
    ```
    **Response**:
    ```json
    {
        "id": 1,
        "ujian_id": "1",
        "nomor_peserta": "990771",
        "created_at": "2025-03-15T04:28:19.000000Z",
        "updated_at": "2025-03-15T04:46:13.000000Z"
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

-   ### Sesi Soal
    **Method**:POST
    **URL**:/admin/sesi_soal
    **Body**:
    ```json
    {
        "sesi_ujian_id": "1",
        "soal_id":"1",
        "nomor_peserta":"210425",
        "jawaban":"Jakarta"
    }
    ```
    **Response**:
    ```json
    {
        "sesi_ujian_id": "1",
        "soal_id": "1",
        "nomor_peserta": "210425",
        "jawaban": "Jakarta",
        "updated_at": "2025-03-15T04:52:50.000000Z",
        "created_at": "2025-03-15T04:52:50.000000Z",
        "id": 1
    }
    ```

    **Method**:GET
    **URL**:/admin/sesi_soal
    **Response**:
    ```json
   {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "sesi_ujian_id": 1,
                "nomor_peserta": 210425,
                "soal_id": 1,
                "tipe_soal": null,
                "jawaban": "Jakarta",
                "created_at": "2025-03-15T04:52:50.000000Z",
                "updated_at": "2025-03-15T04:52:50.000000Z",
                "sesi_ujian": {
                    "id": 1,
                    "ujian_id": 1,
                    "nomor_peserta": 990771,
                    "created_at": "2025-03-15T04:28:19.000000Z",
                    "updated_at": "2025-03-15T04:46:13.000000Z"
                },
                "soal": {
                    "id": 1,
                    "ujian_id": 1,
                    "soal": "Apa ibu kota Indonesia?",
                    "image": null,
                    "tipe_soal": "pilihan_ganda",
                    "pilihan_a": "Jakarta",
                    "pilihan_b": "Bandung",
                    "pilihan_c": "Surabaya",
                    "pilihan_d": "Medan",
                    "pilihan_e": "Makassar",
                    "jawaban": "Jakarta",
                    "created_at": "2025-03-15T04:27:53.000000Z",
                    "updated_at": "2025-03-15T04:27:53.000000Z"
                },
                "peserta": {
                    "id": 3,
                    "nomor_peserta": 210425,
                    "password": "AAAAAAAA",
                    "remember_token": null,
                    "nama": "Adit",
                    "alamat": null,
                    "kelas_id": 1,
                    "jurusan_id": 1,
                    "agama_id": 1,
                    "created_at": "2025-03-15T04:26:59.000000Z",
                    "updated_at": "2025-03-15T04:26:59.000000Z"
                }
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/admin/sesi_soal?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/api/admin/sesi_soal?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/admin/sesi_soal?page=1",
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
        "path": "http://127.0.0.1:8000/api/admin/sesi_soal",
        "per_page": 10,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    }
    ```

    **Method**:PUT
    **URL**:/admin/sesi_soal/{id}
    **Body**:
    ```json
    {
        "sesi_ujian_id": "1",
        "soal_id":"1",
        "nomor_peserta":"210425",
        "jawaban":"Bekasi"
    }
    ```
    **Response**:
    ```json
    {
        "sesi_ujian_id": "1",
        "soal_id":"1",
        "nomor_peserta":"210425",
        "jawaban":"Bekasi"
    }
    ```

    **Method**:DELETE
    **URL**:/admin/sesi_soal/{id}
    **Response**:
    ```json
    {
        "message": "Data deleted"
    }
    ```

-   ### Submit Ujian
    **Method**:POST  
    **URL**:/api/submit-ujian  
    **Body**:  
    ```json
    {
        "data": [
            {
                "ujian_id": 1,
                "nomor_peserta": "210425",
                "soal_id": 1,
                "tipe_soal": "pilihan_ganda",
                "jawaban": "Jakarta"
            },
            {
                "ujian_id": 1,
                "nomor_peserta": "210425",
                "soal_id": 2,
                "tipe_soal": "essay",
                "jawaban": "Ibu kota Indonesia adalah Jakarta."
            }
        ]
    }
    ```  
    **Response**:  
    ```json
    {
        "message": "Answers submitted successfully."
    }
    ```  

    **Error Responses**:  

    - **Validation Error**:  
        ```json
        {
            "error": "The data field is required."
        }
        ```  

    - **Data Not Found**:  
        ```json
        {
            "error": "Data not found"
        }
        ```  

    - **Server Error**:  
        ```json
        {
            "error": "An error message describing the issue."
        }
        ```
-   ### Get Hasil Ujian
    **Method**: GET  
    **URL**: /admin/hasil_ujian  
    **Query Parameters**:  
    - `limit` (optional): Number of results per page. Default is 10.  

    **Response**:  
    ```json
    {
        "current_page": 1,
        "data": [
            {
                "nama": "Adit",
                "ujian_id": 1,
                "soal": "Apa ibu kota Indonesia?",
                "jawaban_soal": "Jakarta",
                "jawaban_sesi": "Jakarta",
                "isTrue": true
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/admin/hasil_ujian?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/api/admin/hasil_ujian?page=1",
        "next_page_url": null,
        "path": "http://127.0.0.1:8000/api/admin/hasil_ujian",
        "per_page": 10,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    }
    ```

-   ### Reevaluate Hasil Ujian
    **Method**: POST  
    **URL**: /admin/hasil_ujian/reevaluate  

    **Response**:  
    ```json
    {
        "message": "Hasil ujian reevaluated successfully."
    }
    ```

-   ### Migrate Hasil Ujian
    **Method**: POST  
    **URL**: /admin/hasil_ujian/migrate  

    **Response**:  
    ```json
    {
        "message": "Hasil ujian migrated successfully."
    }
    ```