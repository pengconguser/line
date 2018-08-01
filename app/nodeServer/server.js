var http = require('http');
var querystring = require('querystring');
var socket = require('socket.io');
var app,io;
io = socket.listen(1338);
app = http.createServer(function (req, res) {
    var body = "";
    req.on('data', function (chunk) {
        body += chunk;
    });
    req.on('end', function () {
        // 解析参数
        body = querystring.parse(body);
        // 设置响应头部信息及编码
        res.setHeader('Access-Control-Allow-Origin', '*');
        res.writeHead(200, {'Content-Type': 'application/json;charset=utf8'});
        if(req.url == '/'){
            if(body) { // 输出提交的数据
                res.write(JSON.stringify(body));
                io.sockets.emit('carState',body);
            } else {  // 输出表单
                res.write('no data');
            }
        }else if(req.url == '/msg'){
            if(body){
                res.write(JSON.stringify(body));
                io.sockets.emit('msg_send_server',body);
            }else{
                res.write('no data');
            }
        }
        res.end();
    });
});
app.listen(1337);


io.sockets.on("connection",function (socket) {
    socket.on("msg_receive_server",function (data) {
        // socket.broadcast.emit("msg_send_server","你们好");
        io.sockets.emit('msg_send_server',data);
    });
});


