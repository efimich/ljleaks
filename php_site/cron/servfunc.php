<?

function req_link($link) {

    $url = parse_url($link);

    $hostname = $url['host'];
    $post = $url['path'];

    $service_port = 80;
    //$address = gethostbyname($hostname);
    $address = "208.93.0.128";

    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if ($socket === false) {
        //echo "socket_create() failed: reason: ".socket_strerror(socket_last_error())."\n";
        return -1;
    };

    $result = socket_connect($socket, $address, $service_port);
    if ($result === false) {
        //echo "socket_connect() failed.\n";
        //echo "Reason: ($result) ".socket_strerror(socket_last_error($socket))."\n";
        return -2;
    };

    $in  = "HEAD $post HTTP/1.1\r\n";
    $in .= "Host: $hostname\r\n";
    $in .= "Connection: Close\r\n\r\n";

    socket_write($socket, $in, strlen($in));

    $data = "";
    while ($out = socket_read($socket, 2048)) {
        $data.=$out;
    }

    $code = -3;
    if (preg_match("/HTTP\/1\.1 (\d+)/",$data,$m)) {
        $code = intval($m[1]);
    } else {
        //echo "HTTP reponse match fail\n";
        return -4;
    };

    socket_close($socket);

    return $code;
};

?>
