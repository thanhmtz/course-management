<!DOCTYPE html>
<html>
<head>
    <title>CMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/dashboard">📚</a>

        <div>
            <a href="/courses" class="btn btn-outline-light btn-sm">Courses</a>
            <a href="/enrollments/create" class="btn btn-outline-success btn-sm">Enroll</a>
        </div>
    </div>
</nav>

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

</div>

</body>
</html>