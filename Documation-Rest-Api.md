## Login Warga
	-Endpoint ( https://pam.syahrizalalisadikin.com/api/login ) { Method: POST }
		
		+ Request (application/json)
			{
			  "email": "iqbal@gmail.com",
			  "password": "password"
			}

		+ Response (application/json)
			{
			  "status": 200,
			  "data": {
			    "warga_id": 2,
			    "fk_rw_id": "001",
			    "nama": "iqbal nw",
			    "email": "iqbal@gmail.com",
			    "phone": "08982882",
			    "tempat_lahir": "1231",
			    "tanggal_lahir": "1231",
			    "jenis_kelamin": "laki",
			    "alamat": "jakarta",
			    "user_id": "001",
			    "foto_ktp": "3P06rOFMA",
			    "foto_kk": "AHfCze4wE",
			    "foto_profile": "uIclBGKO4",
			    "created_at": "2020-08-31T08:50:26.000000Z",
			    "updated_at": "2020-08-31T16:31:59.000000Z"
			  },
			  "token": 				   					
				"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsdW1lbi1qd3QiLCJzdWIiOnsid2FyZ2FfaWQiOjIsImZrX3J3X2lkIjoiMDAxIiwibmFtYSI6ImlxYmFsIG53IiwiZW1haWwiOiJpcWJhbEBnbWFpbC5jb20iLCJwaG9uZSI6IjA4OTgyODgyIiwidGVtcGF0X2xhaGlyIjoiMTIzMSIsInRhbmdnYWxfbGFoaXIiOiIxMjMxIiwiamVuaXNfa2VsYW1pbiI6Imxha2kiLCJhbGFtYXQiOiJqYWthcnRhIiwidXNlcl9pZCI6IjAwMSIsImZvdG9fa3RwIjoiM1AwNnJPRk1BIiwiZm90b19rayI6IkFIZkN6ZTR3RSIsImZvdG9fcHJvZmlsZSI6InVJY2xCR0tPNCIsImNyZWF0ZWRfYXQiOiIyMDIwLTA4LTMxVDA4OjUwOjI2LjAwMDAwMFoiLCJ1cGRhdGVkX2F0IjoiMjAyMC0wOC0zMVQxNjozMTo1OS4wMDAwMDBaIn19.jpJJHQZeq7meNqzIdT5u74j9Dly_XJRGnmztecF1ODc"
			}

## Get All Users Warga
	-Endpoint ( https://pam.syahrizalalisadikin.com/api/warga ) { Method: GET }
		
		+ Request
			Authorization: pdam {token}
		
		+ Response (application/json)	
			{
			  "status": 200,
			  "data": [
			    {
			      "warga_id": 2,
			      "fk_rw_id": "001",
			      "nama": "iqbal nw",
			      "email": "iqbal@gmail.com",
			      "phone": "08982882",
			      "tempat_lahir": "1231",
			      "tanggal_lahir": "1231",
			      "jenis_kelamin": "laki",
			      "alamat": "jakarta",
			      "user_id": "001",
			      "foto_ktp": "3P06rOFMA",
			      "foto_kk": "AHfCze4wE",
			      "foto_profile": "uIclBGKO4",
			      "created_at": "2020-08-31T08:50:26.000000Z",
			      "updated_at": "2020-08-31T16:31:59.000000Z"
			    },
			    {
			      "warga_id": 4,
			      "fk_rw_id": "001",
			      "nama": "izal",
			      "email": "izal@izal.com",
			      "phone": "08982882",
			      "tempat_lahir": "1231",
			      "tanggal_lahir": "1231",
			      "jenis_kelamin": "laki",
			      "alamat": "Bekasi",
			      "user_id": "001",
			      "foto_ktp": "k4KE82R4g",
			      "foto_kk": "mxOd5u9LT",
			      "foto_profile": "zsdMm3J1o",
			      "created_at": "2020-08-31T08:53:53.000000Z",
			      "updated_at": "2020-08-31T17:21:48.000000Z"
			    },
			  ]
			} 

## Insert Warga / Create Warga
	- Endpoint ( https://pam.syahrizalalisadikin.com/api/warga-register ) { Method: POST }

		+ Request

			+ Header 
				Content-Type: application/json

			{
				"fk_rw_id": "001",
				"nama": "akbar",
				"email": "akbar@gmail.com",
				"password": "password",
				"phone": "08928832"
			}

		+ Response (Code: 200)
			{
			  "status": 200,
			  "data": {
			    "fk_rw_id": "001",
			    "nama": "akbar",
			    "email": "akbar@gmail.com",
			    "phone": "08928832",
			    "updated_at": "2020-09-03T00:20:11.000000Z",
			    "created_at": "2020-09-03T00:20:11.000000Z",
			    "warga_id": 7
			  }
			}

## Update Warga 
	- Endpoint ( https://pam.syahrizalalisadikin.com/api/warga/{id_warga}/edit ) { Method: POST }

		+ Request

			+ Header 
				Authorization: pdam {token}
				Content-Type: multipart/form-data

			{
				fk_rw_id		: 001,
				nama			: Izal Saputra,
				email			: izal@gmail.com,
				password		: (Note: * Jika ingin ganti password masukan jika tidak kosongkan),
				phone			: 0898277382,
				alamat			: Jln Puncung, Bekasi Selatan,
				tempat_lahir	: Jakarta,
				tanggal_lahir	: 03/04/2001,
				jenis_kelamin	: laki-laki,
				user_id			: 001,
				foto_ktp		: FILE,
				foto_kk			: FILE,
				foto_profile	: FILE,
			}

		+ Response (Code: 200)
			{
			  "status": 200,
			  "data": {
			    "fk_rw_id": "001",
			    "nama": "Izal Saputra",
			    "email": "izal@gmail.com",
			    "phone": "0898277382",
			    "alamat": "Jln Puncung, Bekasi Selatan",
			    "tempat_lahir": "Jakarta",
			    "tanggal_lahir": "03\/04\/2001",
			    "jenis_kelamin": "laki-laki",
			    "user_id": "001",
			    "foto_ktp": "orpwx8PmU",
			    "foto_kk": "bx98ondXL",
			    "foto_profile": "DGMgB7mYL"
			  }
			}

## Get File/Image KTP/KK/Profile
	- Endpoint ( https://pam.syahrizalalisadikin.com/api/image/{file} ) { Method: GET }

		+ Request 
			Authorization: pdam {token}

		+ Response (Code: 200)

			Akan Muncul Image/Gambar Sesuai Nama File Nya Yang Ada Di Database

## Delete Warga 
	- Endpoint ( https://pam.syahrizalalisadikin.com/api/warga/{warga_id} ) { Method: DELETE }

		+ Request 
			Authorization: pdam {token}

		+ Response (Code: 200)
			{
			  "status": 200,
			  "msg": "Success Delete Data User"
			}

## Get Warga Per ID
	- Endpoint ( https://pam.syahrizalalisadikin.com/api/warga/{id_warga}/edit ) { Method: GET }	

		+ Request 
			Authorization: pdam {token}

		+ Response (Code: 200)
			{
			  "status": 200,
			  "data": {
			    "warga_id": 2,
			    "fk_rw_id": "001",
			    "nama": "iqbal nw",
			    "email": "iqbal@gmail.com",
			    "phone": "08982882",
			    "tempat_lahir": "1231",
			    "tanggal_lahir": "1231",
			    "jenis_kelamin": "laki",
			    "alamat": "jakarta",
			    "user_id": "001",
			    "foto_ktp": "3P06rOFMA",
			    "foto_kk": "AHfCze4wE",
			    "foto_profile": "uIclBGKO4",
			    "created_at": "2020-08-31T08:50:26.000000Z",
			    "updated_at": "2020-08-31T16:31:59.000000Z"
			  }
			}