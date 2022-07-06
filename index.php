<!DOCTYPE html>
<html lang="en">

<head>
    <title>mKAOS Studio Lite</title>

    <link rel="stylesheet" href="css/style.css">

    <style type="text/css">
        html,
        body {
            font: 11pt arial;
        }

        h1 {
            font-size: 150%;
            margin: 5px 0;
        }

        h2 {
            font-size: 100%;
            margin: 5px 0;
        }

        table.view {
            width: 100%;
        }

        table td {
            vertical-align: top;
            
        }

        table table {
            background-color: #white;
            border: 0px;
        }

        table table td {
            vertical-align: middle;
        }

        input[type="text"],
        pre {
            border: 1px solid lightgray;
        }

        pre {
            margin: 0;
            padding: 5px;
            font-size: 10pt;
        }

        #mynetwork {
            width: 100%;
            height: 650px;
            border: 1px solid lightgray;
        }

        .button {
            background-color: green;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 18x;
            cursor: pointer;
        }        

        .button-ok {
            background-color: blue;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            font-size: 18x;
            cursor: pointer;
        }        

        .button-cancel {
            background-color: gray;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            font-size: 18x;
            cursor: pointer;
        }        
        

        /* edit divs */
        .hidden {
            display: none;
            position: fixed;
            top: 120px;
            left: 170px;            
            padding: 7px;
            border-style: ridge;
            background-color: #eee;
            box-shadow: 10px 10px 18px #888888;
        }

    </style>

    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/vis-network.js"></script>    
	<script type="text/javascript" src="qrcodejs/qrcode.js"></script>
    <script type="text/javascript" src="js/sweetalert.min.js"></script>
    <script type="text/javascript" src="js/config.js?v=<?php include("rand.php"); ?>"></script>
    <script type="text/javascript" src="js/util.js"></script>  
    <script type="text/javascript" src="js/diagram.js?v=<?php include("rand.php"); ?>"></script>
    <script type="text/javascript" src="js/canvas-toBlob.js"></script>    
    <script type="text/javascript" src="js/Blob.js"></script>        

</head>

<body onload="draw();">

    <div style="float: left;">    
        <img src='images/logomarca_completa_english.png' height='60'/>
    </div>
  
    <div style="float: right;"'>
        <!-- qrcode -->
        <a href="commands.php"  rel="noopener noreferrer" target="_blank">
        <div id="qrcode" style="width:60px; height:60px; margin-top:5px; margin-left:5px;"></div>
  	    <input id="text" type="text" hidden disabled value="http://mimamura.com/diagram/commands.php"/>
        </a>
       	<script type="text/javascript" src='qrcodejs/makeqr.js'></script>
    </div>

    <table class="view">
        <colgroup>
            <col width="7%" />
            <col width="93%" />
        </colgroup>

        <tr>

            <td>
                <?php
                    // toolbar
                    require('elements.php');
                ?>
            </td>

            <td>                 
                <!-- diagram viewport -->
                <div id="mynetwork"></div>

                <!-- para msg de rodape -->
                <span id="operation"> </span>
            </td>

            <td>
                <!-- edit divs -->

                <div id="editSoS" class='hidden'>
                    <h2>SoS editing</h2>
                    <hr>
                    <input id="s-node-id" type="text" value="" hidden/>
                    <p>
                    Name   <input id="s-node-sosname" type="text" value="" />        
                    <p>
                    SoS Type 
                    <select id="s-node-sostype">
                        <option value=""></option>
                        <option value="Directed">Directed</option>
                        <option value="Collaborative">Collaborative</option>
                        <option value="Acknowledged">Acknowledged</option>
                        <option value="Virtual">Virtual</option>
                    </select>                                                              

                    <p>
                    <div class="tooltip"> Provider 
                        <span class="tooltiptext"> Who will be responsible for providing capacities to SoS?</span>
                        <input id="s-node-provider" type="text" value="" /> *
                    </div>

                    <p>
                    <div class="tooltip"> Builder
                        <span class="tooltiptext"> Who will build and operate the SoS?</span>
                        <input id="s-node-builder" type="text" value="" /> *
                    </div>

                    <p>
                    <div class="tooltip"> Beneficiaries
                        <span class="tooltiptext"> Who benefits from SoS? Inform 'nobody' if there are no beneficiaries</span>
                        <input id="s-node-benefits" type="text" value="" /> *
                    </div>

                    <p>
                    <div class="tooltip"> Feedback policy<br/>
                        <span class="tooltiptext"> Name, text or link to feedback policy </span>
                        <textarea id="s-node-policy" rows="4" cols="30"></textarea>
                        <!-- <input id="s-node-policy" type="text" value="" /> * -->
                    </div>

                    <p>* Required fields</u>
                    <p align="right">
                    <button id="node-update" class='button-ok' onclick="updateNode();">Update</button>
                    <button class='button-cancel' onclick="$('#editSoS').hide();">cancel</button>
                </div>                        

                <div id="editConstituent" class='hidden'>
                    <h2>Constituent editing</h2>
                    <hr>
                    <input id="c-node-id" type="text" value="" hidden/>
                    Label <input id="c-node-label" type="text" value="" />
                    <p>
                    Title <input id="c-node-title" type="text" value="" /> 

                    <p>
                    <div class="tooltip"> Interface
                        <span class="tooltiptext"> How will the system communicate with the SoS?</span>
                        <input id="c-node-interface" type="text" value="" /> *
                    </div>
                    <p>* Required field</u>
                    <p align="right">
                    <button id="node-update" class='button-ok' onclick="updateNode();">Update</button>
                    <button class='button-cancel' onclick="$('#editConstituent').hide();">cancel</button>
                </div>

                <div id="editMission" class='hidden'>
                    <h2>Mission editing</h2>
                    <hr>
                    <input id="m-node-id" type="text" value="" hidden/>
                    Label   <input id="m-node-label" type="text" value="" />       
                    <p>
                    Title   <input id="m-node-title" type="text" value="" />        
                    <p>
                    <div class="tooltip"> Available  
                        <span class="tooltiptext">This capacity already available or need to be constructed?</span>                
                        <select id="m-node-available">
                            <option value=""></option>
                            <option value="yes">yes</option>
                            <option value="no">no</option>
                        </select> *
                    </div>
                    <p>                                
                    <div class="tooltip"> Checked  
                        <span class="tooltiptext">This capacity already checked and suitable for SoS?</span>
                        <select id="m-node-checked">
                            <option value=""></option>
                            <option value="yes">yes</option>
                            <option value="no">no</option>
                        </select> *
                    </div>
                    <p>* Required fields</u>
                    <p align="right">
                    <button id="m-node-update" class='button-ok' onclick="updateNode();">Update</button>
                    <button class='button-cancel' onclick="$('#editMission').hide();">cancel</button>
                </div>      

                <div id="editEdge" class='hidden'>
                    <h2>Edge editing</h2>
                    <hr>
                    <input id="edge-id" type="text" value="" hidden/>
                    <div class="tooltip"> Fail type
                        <span class="tooltiptext"> Temporary failures recover on their own 
                            while permanent failures need manual intervention</span>
                    <input type="radio" name="fail" id='f1' value="n">None</input>  
                    <input type="radio" name="fail" id='f2' value="t">Temporary</input>
                    <input type="radio" name="fail" id='f3' value="p">Permanent</input>
                    </div>
                    <p>
                    Label <input id="edge-label" type="text" value="" /> 
                    <p>
                    Title <input id="edge-title" type="text" value="" />
                    <p align="right">
                    <button id="edge-update" class='button-ok' onclick="updateEdge();">Update</button>
                    <button class='button-cancel' onclick="$('#editEdge').hide();">cancel</button>

                </div>       

            </td>

        </tr>
    </table>

    <!-- diagram structure elements -->

    <br/>

    <div class='hidden'>
        <h2>[Nodes]</h2>
        <pre id="nodes"></pre>
    </div>

    <div class="hidden">
        <h2>[Edges]</h2>
        <pre id="edges"></pre>
    </div>

</body>

</html>
