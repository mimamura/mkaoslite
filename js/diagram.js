// functions to manipulate model elements

var nodes, edges, network;
var nodeGet, edgeGet;

const __SOS_HEADER = "SoS properties\n____________\n";
const __MO1_HEADER = "SoS interfaces (MO 1)\n__________________\n";

// clear work area
function clearAll() {
    document.location.reload(true);
}

// check model
function checkModel() {

    // generate error messages
    var msg = '';

    // load nodes 
    nodes_txt = document.getElementById("nodes").innerText;
    if (nodes_txt == '') nodes_txt = '[]';

    var arrayNodes = JSON.parse(nodes_txt);

    // counters
    var cntConstituent = 0
    var cntRefinement = 0
    var cntMission = 0;

    // loop validation for check model button
    arrayNodes.forEach(function (node) {

        // props to test
        var id = node.id;
        var label = node.label;
        var type = node.type;
        var interface = node.interface;
        var available = node.available;
        var checked = node.checked;

        // SoS parameters
        var SoSType = node.SoSType;
        var provider = node.provider;
        var builder = node.builder;
        var benefits = node.benefits;
        var policy = node.policy;

        // elements counters
        if (type == 'refinement') {
            // nothing do proc
            cntRefinement++;
        }

        // SoS heuristics
        if (type == 'SoS') {

            if (SoSType !== 'Virtual') {
                // provider defined?
                if (provider == '') {
                    msg = msg + "Heurístic IN 1- Identify the responsible for providing resources to SoS \n";
                }

                // construtor defined?
                if (builder == '') {
                    msg = msg + "Heurístic IN 2- Identify the responsible for building and operating the SoS \n";
                }

                // beneficiary defided?
                if (benefits == '') {
                    msg = msg + "Heurístic IN 3- Identify who benefits from SoS or inform 'nobody' in SoS properties \n";
                }

                // feedback policy defined?
                if (policy == '') {
                    msg = msg + "Heurístic MO 2- Include the feedback policy for SoS operation \n";
                }

                // SoS type defined?
                if (SoSType == '') {
                    msg = msg + "- Define the SoS type in SoS properties \n";
                }

            }
        }

        // heuristics for constituents
        if (type == 'constituent') {

            cntConstituent++;

            // constituients with no interface?
            if (interface == '') {
                msg = msg + "Heuristic IO 1- No interface defined for [" + label + "] \n";
            }

        }

        // missions heuristics
        if (type == 'mission') {

            cntMission++;

            // capability not available but checked
            if (available == 'no' && checked == 'yes') {
                msg = msg + "Capability [" + label + "] not availabie but checked?\n";
            }

            // capability available?
            if (available == '') {
                msg = msg + "Heurístic SC 1- Define if the capability [" + label + "] is availabie \n";
            }

            // capability checked?
            if (checked == '') {
                msg = msg + "Heurístic SC 2- Define if the capability [" + label + "] was checked \n";
            }
        }

    })

    // SoS without elements
    if (cntConstituent == 0) {
        msg = msg + "- SoS have no constituent systems \n";
    }
    if (cntMission == 0) {
        msg = msg + "- SoS have no capabilities/missions \n";
    }
    if (cntRefinement == 0) {
        msg = msg + "- SoS have no refinements \n";
    }

    // verify problems
    if (msg == '') {
        swal('Check Model', 'No issues found', 'success');
    } else {
        swal('Check Model', msg, 'warning');
    }

}

/* ============== Graphic elements =================*/

// SoS
function addSoS() {
    try {
        seed_node++;
        xy = randomXY(0, __maxScreen / 2);

        nodes.add({
            id: seed_node,
            x: xy[0],
            y: xy[1],
            title: 'SoS general properties',
            shape: 'box',
            color: {
                background: 'white',
                border: 'green',
                highlight: 'LightPink',
            },
            shapeProperties: {
                borderRadius: 5,
            },
            font: {
                align: 'left',
            },
            shadow: {
                enabled: true,
                x: 10,
                y: 10,
            },
            label: __SOS_HEADER +
                "\nName : \nType : \nProvider : \nBuilder : \nBeneficiaires : \nFeedback policy : \n"
            ,
            type: 'SoS',
            SoSName: '',
            SoSType: '',
            provider: '',
            builder: '',
            benefits: '',
            policy: '',
        });
        return seed_node;
    } catch (err) {
        console.log(err);
    }
}

// SoS
function addMo1() {
    try {
        seed_node++;
        xy = randomXY(0, __maxScreen / 2);

        nodes.add({
            id: seed_node,
            x: xy[0],
            y: xy[1],
            title: 'Heuristic MO 1: Maintaining interface patterns',
            shape: 'box',
            color: {
                background: 'lightgreen',
                border: 'green',
                highlight: 'LightPink',
            },
            shapeProperties: {
                borderRadius: 5,
            },
            font: {
                align: 'left',
            },
            shadow: {
                enabled: true,
                x: 10,
                y: 10,
            },
            label: __MO1_HEADER +
                "\n(empty)\n"
            ,
            type: 'mo1',
        });
        return seed_node;
    } catch (err) {
        console.log(err);
    }
}

// constituents
function addConstituent() {
    try {
        seed_node++;
        xy = randomXY(0, __maxScreen / 2);
        nodes.add({
            id: seed_node,
            x: xy[0],
            y: xy[1],
            title: 'Constituent notes ' + seed_node,
            shape: 'diamond',
            color: {
                //background: 'Darkorange',
                background: 'White',
                border: 'red',
                highlight: 'LightPink',
            },
            label: 'Constituent ' + seed_node,
            type: 'constituent',
            interface: '',
            available: '',
            checked: '',
        });
        return seed_node;
    } catch (err) {
        console.log(err);
    }
}

// mission/capability
function addMission() {
    try {
        seed_node++;
        xy = randomXY(0, __maxScreen / 2);
        nodes.add({
            id: seed_node,
            x: xy[0],
            y: xy[1],
            title: 'Mission notes ' + seed_node,
            shape: 'box',
            color: {
                background: 'White',
                border: 'blue',
                highlight: 'LightPink',
            },
            shapeProperties: {
                borderRadius: 0,
            },
            label: 'Mission ' + seed_node,
            type: 'mission',
            interface: '',
            available: '',
            checked: '',
        });
        return seed_node;
    } catch (err) {
        console.log(err);
    }
}

// refinement
function addRefinement() {
    try {
        seed_node++;
        xy = randomXY(0, __maxScreen / 2);
        nodes.add({
            id: seed_node,
            x: xy[0],
            y: xy[1],
            title: 'Refinment notes ' + seed_node,
            shape: 'circle',
            color: {
                background: 'Gold',
                border: 'gray',
                highlight: 'Khaki',
            },
            label: '',
            type: 'refinement',
            interface: '',
        });
    } catch (err) {
        console.log(err);
    }
}

// exclusive gateway 
function addExclusiveGateway() {
    try {
        seed_node++;
        xy = randomXY(0, __maxScreen / 2);
        nodes.add({
            id: seed_node,
            x: xy[0],
            y: xy[1],
            title: 'Gateway Exc ID ' + seed_node,
            label: "",
            shape: 'image',
            image: 'images/exclusive-gateway.png',
            type: 'gateway',
        });
    } catch (err) {
        console.log(err);
    }
}

/* ============== edges ============= */

// link constituent -> capability
function addEdge() {
    try {
        stack_nodes = [];
        operation = 'edge';
        document.getElementById("operation").innerHTML = "Select <img src='images/constituent.png' width='20' /> then <img src='images/mission.png' width='20' /> to link";
    } catch (err) {
        alert(err);
    }
}

// link capapability -> refinement
function addEdgeRefinement() {
    try {
        stack_nodes = [];
        operation = 'edgeRefinement';
        document.getElementById("operation").innerHTML = "Select <img src='images/mission.png' width='20' /> then <img src='images/refinement.png' width='20' /> to link";
    } catch (err) {
        console.log(err);
    }
}

// link refinament -> mission
function addEdgeMission() {
    try {
        stack_nodes = [];
        operation = 'edgeMission';
        document.getElementById("operation").innerHTML = "Select <img src='images/refinement.png' width='20' /> then <img src='images/mission.png' width='20' /> to link";
    } catch (err) {
        console.log(err);
    }
}

/* =============== link edges =============*/

function linkEdge() {
    try {
        seed_edge++;
        var edge_to = stack_nodes.pop();
        var edge_from = stack_nodes.pop();

        // correct types?
        tofrom = edge_to[1] + edge_from[1];

        if (tofrom == 'constituentmission' || tofrom == 'missionconstituent') {

            // arrow direction
            if (edge_from[1] == 'constituent') {
                arr = 'to';
            } else {
                arr = 'from';
            }

            // edges
            edges.add({
                id: seed_edge,
                title: '',
                label: '',
                from: edge_from[0],
                to: edge_to[0],
                arrows: arr,
                color: 'Darkorange',
                type: operation,
                failType: 'none',
                dashes: false,
            });
        } else {
            swal('', 'Only constituent-mission pair allowed', 'error');
        }

        // clear operation queue 
        operation = '';
        stack_nodes = [];
        document.getElementById("operation").textContent = ' ';

    } catch (err) {
        console.log(err);
    }
}

// link da capability -> refinement
function linkEdgeRefinement() {
    try {
        seed_edge++;
        var edge_to = stack_nodes.pop();
        var edge_from = stack_nodes.pop();

        // correct types?
        tofrom = edge_to[1] + edge_from[1];

        // check valid links
        if (tofrom == 'missionrefinement'
            || tofrom == 'refinementmission'
            || tofrom == 'refinementgateway'
            || tofrom == 'gatewayrefinement'
            || tofrom == 'gatewaymission'
            || tofrom == 'missiongateway') {

            // edges
            edges.add({
                id: seed_edge,
                title: '',
                label: '',
                from: edge_from[0],
                to: edge_to[0],
                color: 'Gold',
                type: operation,
                failType: 'none',
                dashes: false,
            });
        } else {
            swal('', 'Only refinement-mission or refinement-gateway pair allowed', 'error');
        }

        // clear operation queue
        operation = '';
        stack_nodes = [];
        document.getElementById("operation").textContent = ' ';

    } catch (err) {
        console.log(err);
    }
}

// link refinement->mission
function linkEdgeMission() {
    try {
        seed_edge++;
        var edge_to = stack_nodes.pop();
        var edge_from = stack_nodes.pop();

        // correct types?
        tofrom = edge_to[1] + edge_from[1];

        if (tofrom == 'missionrefinement' || tofrom == 'refinementmission') {

            // arrow direction
            if (edge_from[1] == 'mission') {
                arr = 'from';
            } else {
                arr = 'to';
            }

            // edges
            edges.add({
                id: seed_edge,
                title: '',
                label: '',
                from: edge_from[0],
                to: edge_to[0],
                color: 'Gold',
                arrows: arr,
                type: operation,
                failType: 'none',
                dashes: false,
            });
        } else {
            swal('', 'Only refinement-mission pair allowed', 'error');
        }

        // clear operation queue
        operation = '';
        stack_nodes = [];
        document.getElementById("operation").textContent = ' ';

    } catch (err) {
        console.log(err);
    }
}

/* ============= updates and removes =================*/

// delete element selection queue
$('html').keydown(function (e) {
    // tecla DEL
    if (e.keyCode == 46) {
        if (stack_nodes.length > 0) {
            removeNode();
        } else if (stack_edges.length > 0) {
            removeEdge();
        } else {
            swal('No edge or node selected to remove');
        }
    }
});

// trash image 
function remove() {
    try {
        if (stack_nodes.length > 0) {
            removeNode();
        } else if (stack_edges.length > 0) {
            removeEdge();
        } else {
            swal('No edge or node selected to remove');
        }
    } catch (err) {
        console.log(err);
    }

}

// remove selected
function removeNode() {
    try {
        var node = stack_nodes.pop();

        // nodes 1 and 2 cant be removeds
        if (node[0] < 3) {
            // remove SoS no possible
            swal("SoS and Interfaces (MO 1) nodes can't be removed");
        } else {

            nodes.remove({
                id: node[0],
            });
            stack_nodes = [];
        }

    } catch (err) {
        console.log(err);
    }

    // hide edit windows
    $('#editSoS').hide();
    $('#editConstituent').hide();
    $('#editMission').hide();
}

// remove selected edges
function removeEdge() {
    try {
        var edge = stack_edges.pop();
        edges.remove({
            id: edge[0],
        });
        stack_edges = [];
    } catch (err) {
        console.log(err);
    }

    // hide edit windows
    $('#editEdge').hide();
}

// update node attribs
function updateNode() {
    try {
        var node = stack_nodes.pop();

        // satisfied conditions?
        var bcolor = 'White';
        var borderWidth = 1;
        var borderDashes = false;

        // hide edit windows
        $('#editSoS').hide();
        $('#editConstituent').hide();
        $('#editMission').hide();

        // manipulate SoS nodes
        if (node[1] == 'SoS') {

            SoSName = document.getElementById("s-node-sosname").value;
            SoSType = document.getElementById("s-node-sostype").value;
            provider = document.getElementById("s-node-provider").value;
            builder = document.getElementById("s-node-builder").value;
            benefits = document.getElementById("s-node-benefits").value;
            policy = document.getElementById("s-node-policy").value;

            if (SoSType != '' && provider !== '' && builder !== ''
                && benefits !== '' && policy !== '') bcolor = 'lightgreen';

            // calc SoS label   
            label = __SOS_HEADER +
                "\nName : " + SoSName +
                "\nType : " + SoSType +
                "\nProvider : " + provider +
                "\nBuilder : " + builder +
                "\nBeneficiaries : " + benefits +
                "\nFeedback policy : " + policy.substr(1, 20) + " \n";

            // update node props
            nodes.update({
                id: node[0],
                label: label,
                color: {
                    background: bcolor,
                },
                SoSName: SoSName,
                SoSType: SoSType,
                provider: provider,
                builder: builder,
                benefits: benefits,
                policy: policy,
            });
        }

        // manipulate constituent nodes
        if (node[1] == 'constituent') {

            label = document.getElementById("c-node-label").value;
            title = document.getElementById("c-node-title").value;
            interface = document.getElementById("c-node-interface").value;

            if (interface !== '') bcolor = 'Darkorange';

            // update node props
            nodes.update({
                id: node[0],
                label: label,
                title: title,
                interface: interface,
                color: {
                    background: bcolor,
                },
            });

            // interfaces fill 
            var arrayNodes = nodes.get();

            // loop to check model
            mo1 = '';
            arrayNodes.forEach(function (node) {
                if (node.type == 'constituent') {
                    if (node.interface == '') interface = '(undefined)'; else interface = node.interface;
                    mo1 = mo1 + "\n[" + node.label + "] : " + interface;
                }
            });

            if (mo1 == '') mo1 = "\n(empty)";

            mo1 = __MO1_HEADER + mo1 + "\n";

            // update interface props
            nodes.update({
                id: 2,
                label: mo1,
            });

        }

        // manip node mission
        if (node[1] == 'mission') {

            label = document.getElementById("m-node-label").value;
            title = document.getElementById("m-node-title").value;
            available = document.getElementById("m-node-available").value;
            checked = document.getElementById("m-node-checked").value;

            // image atribs
            if (available !== '' && checked !== '') bcolor = 'SkyBlue';

            // bold and dash states
            if (available == 'no') borderDashes = true;
            if (checked == 'yes') borderWidth = 4;

            // update node props
            nodes.update({
                id: node[0],
                label: label,
                title: title,
                available: available,
                checked: checked,
                color: {
                    background: bcolor,
                },
                borderWidth: borderWidth,
                shapeProperties: {
                    borderDashes: borderDashes,
                },
            });

        }

        stack_nodes = [];

    } catch (err) {
        console.log(err);
    }

}

// update edgees
function updateEdge() {
    try {
        var edge = stack_edges.pop();
        var title = document.getElementById("edge-title").value;
        var label = document.getElementById("edge-label").value;

        // checkbox types
        var f1 = document.getElementById("f1").checked;
        var f2 = document.getElementById("f2").checked;
        var f3 = document.getElementById("f3").checked;

        // no fail
        if (f1) {
            dashes = false;
            source = 'images/blank.png';
            failType = 'none';

        // temp fail
        } else if (f2) {
            dashes = true;
            source = 'images/timer-event.png';
            failType = 'temporary';

        // permanente fail
        } else if (f3) {
            dashes = true;
            source = 'images/cancel-event.png';
            failType = 'permanent';
        }

        // update edge
        edges.update({
            id: edge[0],
            title: title,
            label: label,
            failType: failType,
            dashes: dashes,

            // edge icon type
            arrows: {
                middle: {
                    enabled: dashes,
                    imageHeight: 32,
                    imageWidth: 32,
                    scaleFactor: 1,
                    src: source,
                    type: "image"
                }
            },
        });

        // clear queue
        stack_edges = [];
        document.getElementById("f1").checked = false;
        document.getElementById("f2").checked = false;
        document.getElementById("f3").checked = false;

        document.getElementById("edge-title").value = '';
        document.getElementById("edge-label").value = '';

    } catch (err) {
        alert(err);
    }

    // hide edit window
    $('#editEdge').hide();

}

/* =========== iteraction canvas init ==========*/

function draw() {

    // create and update nodes
    nodes = new vis.DataSet();

    nodes.on("*", function () {

        // fill JSON with SoS structure

        var nodes_data = JSON.stringify(
            nodes.get(),
            null,
            4
        );

        document.getElementById("nodes").innerText = nodes_data;

        $.ajax({
            method: "POST",
            url: "save_nodes.php?p=" + nodes_data,
            data: { text: $("p.unbroken").text() }
        })
            .done(function (response) {
                $("p.broken").html(response);
            });

    });

    // create and update  edges
    edges = new vis.DataSet();
    edges.on("*", function () {

        var edges_data = JSON.stringify(
            edges.get(),
            null,
            4
        );

        document.getElementById("edges").innerText = edges_data;

        $.ajax({
            method: "POST",
            url: "save_edges.php?p=" + edges_data,
            data: { text: $("p.unbroken").text() }
        })
            .done(function (response) {
                $("p.broken").html(response);
            });

    });

    // get the html to the network
    var container = document.getElementById("mynetwork");

    // init 
    var data = {
        nodes: nodes,
        edges: edges,
    };

    // update general options
    var options = {
        edges: {
            smooth: false,
            width: 3,
        },
        nodes: {
            physics: false,
        },
    };

    // create diagram 
    network = new vis.Network(container, data, options);

    // create initial SoS nodes
    addSoS();
    addMo1();
    
    network.on('click', function  (properties) {onClick(properties);} );
    
    network.on('doubleClick', function  (properties) {onDoubleClick(properties);} );  

    // doubleclick parameters  
    var doubleClickTime = 0;
    var threshold = 200;

    // diff sigle and double clicks
    function onClick(properties) {

        var t0 = new Date();
        if (t0 - doubleClickTime > threshold) {
            setTimeout(function () {
                if (t0 - doubleClickTime > threshold) {
                    doOnClick(properties);
                }
            },threshold);
        }
        
    }

    // element edition
    function onDoubleClick(properties) {

        // hide if void canvas area clicked

        $('#editConstituent').hide();
        $('#editMission').hide();
        $('#editEdge').hide();
        $('#editSoS').hide();

        // nodes clickes -> vars
        var ids = properties.nodes;
        var eds = properties.edges;

        var clickedNodes = nodes.get(ids);
        var clickedEdges = edges.get(eds);

        // load values if node clicked
        if (ids.length > 0) {

            // edit SoS
            if (clickedNodes[0].type == 'SoS') {

                // show edit div
                $('#editSoS').show();

                document.getElementById("s-node-id").value = clickedNodes[0].id;
                document.getElementById("s-node-sosname").value = clickedNodes[0].SoSName;
                document.getElementById("s-node-sostype").value = clickedNodes[0].SoSType;
                document.getElementById("s-node-provider").value = clickedNodes[0].provider;
                document.getElementById("s-node-builder").value = clickedNodes[0].builder;
                document.getElementById("s-node-benefits").value = clickedNodes[0].benefits;
                document.getElementById("s-node-policy").value = clickedNodes[0].policy;

            }

            // edit consituent if void oper (edges)
            if (clickedNodes[0].type == 'constituent') {

                // show edit div
                $('#editConstituent').show();

                document.getElementById("c-node-id").value = clickedNodes[0].id;
                document.getElementById("c-node-label").value = clickedNodes[0].label;
                document.getElementById("c-node-title").value = clickedNodes[0].title;
                document.getElementById("c-node-interface").value = clickedNodes[0].interface;
            }

            // edit mission
            if (clickedNodes[0].type == 'mission') {

                // show edit div
                $('#editMission').show();

                document.getElementById("m-node-id").value = clickedNodes[0].id;
                document.getElementById("m-node-label").value = clickedNodes[0].label;
                document.getElementById("m-node-title").value = clickedNodes[0].title;
                document.getElementById("m-node-available").value = clickedNodes[0].available;
                document.getElementById("m-node-checked").value = clickedNodes[0].checked;
            }

            // load values if edge clicked

        } else if (eds.length > 0) {

            // show edit div
            if (ids.length == 0) $('#editEdge').show();

            f = clickedEdges[0].failType;

            if (f == 'none') {
                document.getElementById("f1").checked = true;
            } else if (f == 'temporary') {
                document.getElementById("f2").checked = true;
            } else if (f == 'permanent') {
                document.getElementById("f3").checked = true;
            }

            document.getElementById("edge-id").value = clickedEdges[0].id;
            document.getElementById("edge-label").value = clickedEdges[0].label;
            document.getElementById("edge-title").value = clickedEdges[0].title;
        }

    }

    // *** nodes stack  ***    

    function doOnClick(properties) {

        // nodes clicked -> vars
        var ids = properties.nodes;
        var eds = properties.edges;

        var clickedNodes = nodes.get(ids);
        var clickedEdges = edges.get(eds);

        // nodes stack    
        if (ids.length > 0) {

            var n = [clickedNodes[0].id, clickedNodes[0].type];
            stack_nodes.push(n);

            // edge const -> capab
            if (operation == 'edge' && stack_nodes.length == 2) {
                try {
                    linkEdge();
                } catch {
                    alert(err)
                }
                // edge capab > refinem
            } else if (operation == 'edgeRefinement' && stack_nodes.length == 2) {
                try {
                    linkEdgeRefinement();
                } catch {
                    alert(err)
                }

            // edge refinem ->mission
            } else if (operation == 'edgeMission' && stack_nodes.length == 2) {
                try {
                    linkEdgeMission();
                } catch {
                    alert(err)
                }

            } else if (operation == 'edgeOperational' && stack_nodes.length == 2) {
                try {
                    linkEdgeOperational();
                } catch {
                    alert(err)
                }

            } else if (operation == 'edgeEvent' && stack_nodes.length == 2) {
                try {
                    linkEdgeEvent();
                } catch {
                    alert(err);
                }

            }

        }

        // edge stack    
        if (eds.length > 0) {
            var e = [clickedEdges[0].id, clickedEdges[0].type];
            stack_edges.push(e);
        }  
        
    }

}
    
