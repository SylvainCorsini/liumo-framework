<html>
<body>
    {function="date('Y')"}
    <h1>{$year}</h1>
    <p>{$message}</p>
    <ul>
        {loop="$users"}
            <li>{$counter}: {$value->firstname} {$value->lastname} {$value->age}yo</li>
        {/loop}
    </ul>
</body>
</html>