<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My New Website</title>
</head>

<body>

  <header>
    <h1>mKAOS Studio Web</h1>
    <p>Software Tutorial</p>
  </header>

<main>
    
    
</main>
<div class="center">

<a id="topo"></a>

<h3>Index</h3>

<ol>
<li><a href='#introducao'>Introduction </a></li>
<li><a href='#exemplo'>SoS mission model example using mKAOS </a></li>
<li><a href='#elementos'>The elements used in the mission model </a></li>
<li><a href='#construindo'>Building a mission model in the tool</a></li>
<li><a href='#heuristicas'>Heuristics for SoS projects</a></li>
<li><a href='#duvidas'>Questions, suggestions and contact</a></li>
</ol>

<a id="introducao"></a>
<h3>1. Introduction</h3>

<p> 
This tool is intended to assist in the design of systems-of-systems (SoS) 
projects and was developed within the scope of the Complex Systems Engineering Laboratory (LabESC) at the Federal University of the State of Rio de Janeiro  (UNIRIO). This tool uses elements notation from the mKAOS Studio tool, developed using the Eclipse environment and built under the Systems Conception Laboratory (ConSiste) at the Federal University of Rio Grande do Norte (UFRN).
<p>
An System-of-systems (SoS) are an arrangements of systems with operational and managerial independence called constituent systems (CS) that unite capabilities to fulfill a new mission that is not the responsibility of any CS in isolation. 
Examples of SoS are smart cities where various public and private systems communicate to promote better urban mobility, emergency care, and health and social welfare.
<p>
The SoS mission model diagram, built with this tool, represents the 
CS involved in SoS design, how these CS participate in SoS and how the capabilities provided are used to generate new 
capabilities needed to fulfill SoS missions. This diagram can make it 
easier to communicate project ideas among managers, systems engineers, and developers in the SoS design phase.
<p>

<h4>1.1 About this tool </h4>

This modeling tool was developed to assist in the SoS design using rules (heuristics) to be applied during SoS modeling. As the diagram is built, the tool helps both in the composition of the elements, criticizing the types of connections, and infilling the necessary attributes for improving the chances of success of the project.
<p>
Possible problems in the model being generated can be evaluated using the [Check Model] button during diagram construction. The messages issued by the tool indicate the identified problems, the elements involved, and the respective heuristic used in the evaluation. The tool's interface also prevents incorrect connections from being made between elements, for example, a CS A linked to another CS B, representing the system. A provides system B, which does not make any sense for an SoS as CS must provide capabilities, not other CS.
<p>
Elements that need additional attributes to be set according the heuristics , appear initially with a white background color in the diagram. Once this information is filled, the element change with the corresponding background color according to mKAOS notation. The figure below shows an example of elements with no attributes indicated (on the left) and with full attributes filled (on the right). The white background notation has been introduced in this tool.

<center>
<img src='../images/elementos_vazados.png' width=600>
<br/>
Figure 1. Hollow and color filled example elements
</center>

<br/><br/><a href='#topo'>[back to the top]</a><br/>

<a id="exemplo"></a>
<h3>2. SoS mission model example using mKAOS</h3>

Below is an example diagram representing an SoS with two constituent systems
providing capability 1 and capability 2. In this model, constituent system 1 (unreliable system) 
provides capability 1, but it may have temporary failures (clock symbol), and so the 
redundant system  was added to the project to provide a redundant capability to capability 1 
in the events of a failure, thus ensuring that the global mission can be 
fulfilled more reliably. The clock and exclusive gateway notations were introduced in this tool.
<center>
<img src='../images/exemplo_sos.png' width=600>
<br/>
Figure 2. SoS diagram example
</center>

<br/><br/><a href='#topo'>[back to the top]</a><br/>

<a id="elementos"></a>
<h3>3. The elements used in the mission model </h3>

The mKAOS mission model diagram uses the following elements:
<table>
<tr>
    <td> <img src='../images/mini-constituent.png' width=50/> </td>
    <td> Constituent system. Independent system that provides one or more capabilities to the SoS. </td>
</tr>
<tr>
    <td> <img src='../images/mini-mission.png' width=50/> </td>
    <td> Mission. Represents a individual mission provided by a CS or a mission accomplished by the SoS.</td>
</tr>
<tr>
    <td> <img src='../images/mini-refinement.png' width=50/>  </td>
    <td> Refinement. It is an activity designed to process one or more capabilities provided to deliver new capabilities or perform SoS missions. </td>
</tr>
<tr>
    <td> <img src='../images/responsible_for.png' width=50/>  </td>
    <td> CS Responsible for. Link that indicates a CS is responsible for delivering a particular mission. </td>
</tr>
<tr>
    <td> <img src='../images/refinement_to.png' width=50/>  </td>
    <td> Refinement responsible for. Link that indicates that a particular refinement is responsible for delivering a new mission. </td></tr>
<tr>
    <td> <img src='../images/link_refinement.png' width=50/>  </td>
    <td> Mission provisioning for refinement. Link that indicates which missions are delivered for refinement. Note that there is no arrow on this edge, as there is no mission delivery for the SoS.
    </td>
</tr>

</table>

<p>
In addition to the above elements, mKAOS Studio Lite adds the following elements borrowed from Business process modeling notation (BPMN) :
<table>
<tr>
    <td> <img src='../images/exclusive-gateway.png' width=40/> </td>
    <td> Exclusive gateway. Used to represent that there is more than one constituent system available to provide redundancy in case of failure. </td></tr>
<tr>
    <td> <img src='../images/timer.png' width=30/> </td>
    <td> Temporary failure. Happens when a system stops providing a capability but returns to provide it without the need for action, such as when there is a network problem.</td></tr>
<tr>
    <td> <img src='../images/cancel.png' width=30/> </td>
    <td> Permanent failure. Occurs when a system stops responding and action is required to make it works again or is being replaced, such as when a systems upgrade causes an web service stops responding.
    </td>
</tr>
</table>

<p>
Below is a schematic of the tool's interface elements:
<br/>
<p align='center'><img src='../images/mkaoslite.png' width= 800/>
<br/>
<center>    
Figure 3. Elements of tool interface
</center>

<br/><br/><a href='#topo'>[back to the top]</a><br/>

<a id="construindo"></a>
<h3>4. Building a mission model diagram with the tool</h3>

To build an SoS diagram using this tool, you can follow these steps:

<p>Step 1. Identify which CS with the respective capabilities will be used by SoS, creating an element for each one by clicking on the palette:
<ul>
<li>
    Click on the <img src='../images/mini-constituent.png' width=40> symbol to create each of the CS. 
</li>    
<li>
    Click on each of the symbols of the CS and change its name in the editing box, modifying the generic name given by the tool in the Label field and the Hint to be shown when the mouse lands on the figure (optional).
</li>
<li>
    Identify which missions must be combined to generate new missions and realize the side missions and the global SoS mission.
</li>
<li>
    Click on the <img src='../images/mini-mission.png' width=40> symbol to create each of the missions.
 /li>
<li>
    Click on each of the mission symbols and change its name in the editing box, modifying the generic name given by the tool in the Label field and the Hint to be shown when the mouse lands on the figure (optional).
</li>
<li>
    Link the CS to their respective mission provided by clicking on the symbol 
    <img src='../images/responsible_for.png' width=40/> and then in the pair system-mission to bind them.
    The tool chooses the correct arrow direction.
</li>
</ul>

<p>
Step 2. Identify what refinements are needed and what missions are involved in each refinement:
<ul>
<li>    
Click on the <img src='../images/mini-refinement.png' width=40/> symbol to create the representation of the necessary refinements for each of the processes to utilize the missions.
</li>
<li>
Click on the <img src='../images/link_refinement.png' width=40/> symbol and link missions to be refined (combined, processed, etc.) by each of the refinements created.
</li>
<li>
Click on the <img src='../images/mini-mission.png' width=40> symbol to create the new mission being delivered by refinement.
</li>
<li>
For each refinement, click on the <img src='../images/refinement_to.png' width=40/> symbol to create the
new mission to be delivered to the SoS.
</li>
<li>
Click on the <img src='../images/refinement_to.png' width=40/> symbol and link the refinements to their respective new missions.
</li>
</ul>

<p>Step 3. If necessary, repeat step 2 to create more refinements until it was able to represent the SoS global mission.

<p>If you already identify possible flaws in the design, follow to the step 4.

<p>Step 4. Identify what are the possible failures of the CS and represent them in the model.

<ul>
<li>
Click on the edge <img src='../images/responsible_for.png' width=40> and inform the CS that can exhibit failure and choose the failure type option in the editing. An icon representing the type of failure will be added to the link.
</li>
<li>
If it is already possible to identify a redundant capability for the possible failure, create the CS and respective redundant capability using step 1.
</li>
<li>
    Click on the <img src='../images/exclusive-gateway.png' width=40> symbol to create the representation for alternative consumption in case of failure and link this symbol to the involved capability.
</li>
<li>
<p> - Link <img src='../images/exclusive-gateway.png' width=40> to the respective refinement, denoting that redundant capability can be consumed in case of main capability failure.
</li>
</ul>

<p>To delete any element created, just click on it and then click on
    <img src='../images/trash.png' width=40> icon or [DEL] key.

<br/><br/><a href='#topo'>[back to the top]</a><br/>

<a id="heuristicas"></a>
<h3>5 - Heuristics for SoS design</h3>

Heuristics are criteria, key points or "golden rules" used in some activity to attend to fulfill a certain proposal. The heuristic can be considered a "mental shortcut" used to get to results from complicated questions quickly and easily, even considering uncertain or incomplete information in the process.
<br/><br/>
A method for evaluation of user interfaces based on heuristics was proposed by Jakob Nielsen and Rolf Molich and consists of inspections guided by ten heuristics to find problems in a user interface.

In this tool, we use heuristics to help build SoS design.
They can be checked via the [Check Model] button at the bottom of the left toolbar. Below are the description of heuristics used in this tool:
<br/><br/>
<b>Initialization heuristic IN 1</b> - The project should clearly identify who provides the capabilities and resources
necessary for the operation of the SoS.
<br/><br/>
SoS depends on the synergy between systems that provides the necessary capabilities for its operation,
it is necessary to guarantee who supplies them. Example: in an SoS for the prevention of natural disasters, there is
a responsible person able to indicate which systems can be integrated to the SoS?
<br/>
<br/>
<b>Initialization heuristic IN 2</b> - The project should clearly identify who is responsible for the
construction and operation of the SoS.
<br/><br/>
When funding is needed for the operation of the SoS, those involved must inform how and by whom this
it will be done so that these issues are dealt with at the appropriate time. Example: How much will it cost and who
goes to the activities and resources needed to build and maintain the SoS, in addition to those already available
by constituent systems?
<br/>
<br/>
<b>Initialization heuristic IN 3</b> - The project should clearly identify who benefits from SoS.
<br/><br/>
Every SoS is built and operates for a purpose.  It is important to identify who are the beneficiaries of 
the activities or operation of the SoS. Example: who are the possible users of SOS and what is the value of
what SoS produces to them?
<br/>
<br/>

<b>Constituent systems heuristic CS 1 </b> - Define which capabilities are already available and which they need
be implemented in the constituent systems for the construction and operation of the SoS.
<br/><br/>
The SoS project must anticipate whether the necessary functionalities already exist in the constituent systems or
whether it will be necessary to implement new features. Example: it will be necessary to demand that a system
of traffic control provides a new capability to produce information to assist
on the ambulance path?
<br/>
<br/>
<b>Constituent systems heuristic CS 2</b> - Individual capabilities need to be checked.
<br/><br/>
Each capability of the constituent systems must be checked to see if it matches what is expected.
Example: The designer must verify that the capability of a localization system is available with the
frequency and accuracy suitable for the purpose of the SoS.
<br/>
<br/>
<b>Interoperability heuristic IO 1</b> - The interfaces between the constituent systems and the SoS must
be defined during the project.
<br/><br/>
The interfaces between the constituent systems and the SoS are a crucial factor for the operation of the SoS and
they are points where the designer can exert influence. Example: The communication required between
2 constituent systems is satisfactorily available for SoS operation or will be required
build new channels for connectivity?
<br/>
<br/>
<b>Monitoring heuristic MO 1 </b> - The interface patterns that emerged in the evolutionary process
must be identified.
<br/><br/>
The evolutionary process (eg upgrades) may require new communication standards or the updating of projected standards
initially. It is necessary to maintain a set of standards used according to the constituent systems and
the SoS itself evolve, generating a roadmap for the process. Example: When a new hospital becomes part
of the municipal health system, it is necessary to include the communication standards of their systems in the project
of the SoS if necessary.
<br/><br/>
<b>Monitoring heuristic MO 2 </b> - The SoS project should include a feedack policy for the operation
of the SoS.
<br/><br/>
It is necessary to monitor the SoS to detect problems during its operation and define the actions required to
deal with them. For example: Is it necessary to monitor the average time of emergency medical care and the respective
vacation schedule of professionals to adjust public health activities in a smart city?

<br/><br/><a href='#topo'>[back to the top]</a><br/>

<a id="duvidas"></a>
<h3>6. Questions, suggestions and contact</h3>

<p>In case of questions or suggestions, please contact us by email:
<p>marcio.imamura@gmail.com
<br/>

</main>

  <footer>
    <p>Thank you for contributing to this study!</p>
  </footer>


</body>
</html>
