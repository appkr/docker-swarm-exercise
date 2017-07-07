<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Docker Swarm Golden Image</title>
</head>
<body>
  <p>PRIVATE_IP : <?= gethostbyname(gethostname()); ?></p>
  <p>CONTAINER_ID : <?= gethostname(); ?></p>
  <p>APP_ENV : <?= getenv('APP_ENV') ?: 'local'; ?></p>
  <p>APP_VERSION : <?= trim(exec('git log --pretty="%h" -n1 HEAD')) ?: 'unknown'; ?></p>
</body>
</html>