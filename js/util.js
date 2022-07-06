// utility functions

function loadJSON(path, success, error) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        success(JSON.parse(xhr.responseText));
      }
      else {
        error(xhr);
      }
    }
  };
  xhr.open('GET', path, true);
  xhr.send();
}

function getScaleFreeNetwork(nodeCount) {
  var nodes = [];
  var edges = [];
  var connectionCount = [];
  return { nodes: nodes, edges: edges };
}

// random seed
var randomSeed = 764; // Math.round(Math.random()*1000);
function seededRandom() {
  var x = Math.sin(randomSeed++) * 10000;
  return x - Math.floor(x);
}

// random x/y position to new objects
function randomXY(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);

  var xy = [0, 0];
  xy[0] = Math.floor(Math.random() * (max - min)) + min;
  xy[1] = Math.floor(Math.random() * (max - min)) + min;

  return xy;
}

function getScaleFreeNetworkSeeded(nodeCount, seed) {
  if (seed) {
    randomSeed = Number(seed);
  }
  var nodes = [];
  var edges = [];
  var connectionCount = [];
  var edgesId = 0;

  return { nodes: nodes, edges: edges };
}

// stringify JSON oject
function toJSON(obj) {
  return JSON.stringify(obj, null, 4);
}
