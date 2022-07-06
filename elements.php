<?php

// tool bar options, images, width, function

$opt = array(
    array('constituent.png', 70, 'addConstituent()','Add constituent system'),
    array('mission.png', 55, 'addMission()','Add mission/capability'),
    array('refinement.png', 55, 'addRefinement()','Add refinment'),
    array('exclusive-gateway.png', 40, 'addExclusiveGateway()','Add exclusive gateway'),

    array('td',0,'',''),

    array('responsible_for.png', 60, 'addEdge()','Link constituent responbible for capability'),
    array('link_refinement.png', 60, 'addEdgeRefinement()','Link capability to refinement'),
    array('refinement_to.png', 60, 'addEdgeMission()','Link refinement to respective mission'),

);

// proc itens

echo '<table>
    <tr><td align="center">
';

foreach($opt as $o) {

    if ($o[0]=='td') {
        echo '</td><td>';
    } else {
        echo '<div class="tooltip">  
                <span class="tooltiptext">'.$o[3].'</span>        
                <input type="image" 
                src="images/'.$o[0].'" width="'.$o[1].'" 
                onclick="'.$o[2].';" /> 
            </div>';
    }
}
echo '</td></tr></table> </font>';
echo '<p align="center">
        <div class="tooltip" >
        <span class="tooltiptext"> Remove the selected node or edge</span>
        <input type="image" src="images/trash.png" height = 30 onclick="remove()" /> 
        or <input type="button" value="Del" onclick="remove();" />
        </div>
';        
echo '
    <br/><br/>
    <div class="tooltip" >
        <span class="tooltiptext"> Clear all nodes and edges</span>
        <p align="center"><button id="check-model" onclick="clearAll()">Clear canvas</font></button>
    </div>
';
echo '
    <br/><br/>    
    <div class="tooltip" >
        <span class="tooltiptext">Evaluate the design model using heuristics</span>
        <button class="button" 
        id="check-model" onclick="checkModel()">Check Model</font></button>
    </div>
';
echo '
    <br/><br/>
    <p align="center">
    <font size=+1><b>
    <a href="tutorial/" target="_blank" >
    <img src="images/tutorial.png" width=20 /> Tutorial
    </a>
    </font></b>
';
echo '
    <br/><br/>
    <p align="center">
    * Right-click on the canvas to save the SoS model image
';
