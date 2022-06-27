<?php require_once(__DIR__ . '/libs/inc.php'); ?>
<?php $ctest = preg_replace("/[^0-9]/", '', filter_input(INPUT_GET, 't', FILTER_SANITIZE_STRIPPED)); ?>
<?php $startTime = microtime(true); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   
</head>
<body>

<main>
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;overflow-y: auto;">
        <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">#PHP2022</span>
            <hr />
        </div>
        <hr>
        <div style="overflow-y: auto; min-height: calc(100% - 150px)">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?php if(!$ctest){ echo 'active'; } ?>" aria-current="page">Home</a>
                </li>
                <?php  foreach(getTestItems() as $item): ?>
                    <li class="nav-item">
                        <a href="index.php?t=<?php echo $item['f']; ?>" class="nav-link <?php if($ctest==$item['p']){ echo 'active'; } ?>" aria-current="page"><?php echo $item['f']; ?></a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>


        <div>
            <hr />
            <span class="badge bg-primary" id="version">v0.1</span>
            <span class="badge bg-danger" id="exTime"></span>
            <span class="badge bg-success" id="totalMem"></span>
        </div>
    </div>
    <div class="b-example-divider"></div>
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: calc(100% - 320px); overflow-y: auto;">
        <?php getPage(); ?>
    </div>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script>
    const time = "<?php echo number_format((microtime(true) - $startTime), 4)." s"; ?>";
    const ram = "<?php echo getFileSizeName(memory_get_peak_usage());?>";
    document.querySelector("#exTime").innerHTML = time;
    document.querySelector("#totalMem").innerHTML = ram;
</script>
</body>
</html>
