<!DOCTYPE html>
<html>
<head>
	<title>tets</title>
</head>
<body>

	<h2>hallo</h2>
	
	<form method="POST" action="{{ route('warga.update',2) }}" enctype="multipart/form-data">
		@csrf
		{{ method_field('PUT') }}

		<input type="file" name="foto_ktp"><br>
		<input type="file" name="foto_kk"><br>
		<input type="file" name="foto_profile"><br>

		<button type="submit">submit</button>
	</form>

</body>
</html>