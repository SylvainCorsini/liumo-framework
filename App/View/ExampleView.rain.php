<html>
<body>
    <?php echo 'test'; ?>
    <h1>{$year}</h1>
    <p>{$message}</p>
    <ul>
        {loop="$users"}
            <li>{$value->firstname} {$value->lastname}: {$value->age}</li>
        {/loop}
    </ul>
</body>
</html>