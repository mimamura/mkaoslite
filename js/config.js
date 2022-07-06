// constants, main variables and objects

// url base para evitar chamadas Access-Control-Allow-Origin

const __baseUrl = window.location.protocol + "//" + window.location.host + "/diagram_heuristics/";

// timeout of queue loop 
const __times = 360;
const __interval = 5000;

// constants to diagram
const __maxScreen = 300;

// sequential ids
var seed_node = 0, seed_edge = 0;

// clicked elements stack_edges
var stack_nodes = [], stack_edges = [];

// operation link (2) clicks
var operation;

/* ========= loop with timer ======= */

// i / # iterac to loop / interval btw iterac

var i = 0;
var loop_length = __times;
var loop_speed = __interval;

// loop to verify the cmd queue and server workers
function loop() {
    i += 1;

    $.ajax({
        method: "POST",
        url: __baseUrl + "get_cmd.php",
        data: { text: $("p.unbroken").text() }
    })
        .done(function (response) {

            // process return
            c = JSON.parse(response);

            // current time and date            
            var today = new Date();
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

            if (c.cmd == 'message') {
                // message to operator

                swal('', c.txt, c.msg_type);

            } else if (c.cmd == 'create constituent') {
                // add constituent 

                id = addConstituent();
                nodes.update({
                    id: id,
                    label: c.label + " - created at " + time,
                    title: c.title,
                });

            } else if (c.cmd == 'create mission') {
                // add mission

                id = addMission();
                nodes.update({
                    id: id,
                    label: c.label + "  - created at " + time,
                    title: c.title,
                });
            }
        });

    // limpa o loop
    if (i === loop_length) {
        tempo = __times * __interval / 1000;
        swal('The page must be reloaded every ' + (tempo / 60) + ' minutes.');
        clearInterval(handler);
    }

}

var handler = setInterval(loop, loop_speed);

