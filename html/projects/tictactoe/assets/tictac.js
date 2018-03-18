var buttons =  [];

for(i=0;i<3;i++){
	buttons[i]=[];
}

var isTie = false;
var isOver = false;
var movesLeft = 9;
var outputDiv = document.getElementById("output");
var refreshDiv = document.getElementById("refresh");
var aiGoFirst = false;
var aiHasGoneFirst = false;

var action = function(x,y){
	if(!isOver){
		if(x==-1 && y==-1){
			aiGoFirst = true;
			if(!aiHasGoneFirst){
				aiHasGoneFirst = true;
				runAI();
			}
		}
		else{
			if(buttons[x][y].isFree){
				if(movesLeft>0 && !isOver){
 	  				  move(x,y,"X");
					aiHasGoneFirst=true;
				}
				if(movesLeft>0 && !isOver){
	  	  			runAI();
				}
			}
		}
	}
}

var move = function(x,y,choice){
	if(movesLeft>0){
		buttons[x][y].domNode.innerHTML=choice;
		buttons[x][y].isFree=false;
		movesLeft--;

		//col
		for(i=0;i<3;i++){
			if(buttons[x][i].domNode.innerHTML !== choice){
				break; //doesnt match current player so doesnt win
			}
			if(i==2){ //got to end of col so is winner
				isOver = true;
			}
		}
		//row
		for(i=0;i<3;i++){
			if(buttons[i][y].domNode.innerHTML !== choice){
				break;
			}
			if(i==2){
				isOver = true;
			}
		}
		//diag \
		if(x==y){
			for(i=0;i<3;i++){
				if(buttons[i][i].domNode.innerHTML !== choice){
					break;
				}
				if(i == 2){
					isOver = true;
				}
			}
		}
		//other diag /
		if((x + y) == 2){
			for(i=0;i<3;i++){
				if(buttons[i][2-i].domNode.innerHTML !== choice){
					break;
				}
				if(i == 2){
					isOver = true;
				}
			}
		}

		//tie
		if(movesLeft == 0){
			isTie = true;
			isOver = true;
		}
	}

	if(isOver){
		if(!isTie){
		outputDiv.innerHTML = choice+" WINS"
		}
		else{
		outputDiv.innerHTML = "TIE";
		}
	}
	if(isTie || isOver){
		var refreshButton = document.createElement("button");
		refreshButton.innerHTML = "Refresh page"
		refreshButton.onclick = function() {location.reload();}
		refreshDiv.appendChild(refreshButton);
	}
}
var runAI = function(){
  var aiX = AICalc();
  var aiY = AICalc();
  while(buttons[aiX][aiY].isFree==false){
	aiX = AICalc();
        aiY = AICalc();
  }
  //console.log("AI X="+aiX+" Y="+aiY );
  move(aiX,aiY,"O");
}

var AICalc = function(){
  var choice = Math.floor(Math.random()*10%3);
  //console.log(choice);
  return choice;
}

var onLoad = function(){
  var container = document.getElementById("buttons");
        for(x=0;x<3;x++){
                for(y=0;y<3;y++){
                        buttons[x][y] = {
                                value: x.toString() + y.toString(),
                                domNode: document.createElement("button"),
				isFree: true
                        }
	  	  buttons[x][y].domNode.innerHTML = buttons[x][y].value;
	  	  buttons[x][y].domNode.style.height = "50px";
	  	  buttons[x][y].domNode.style.width = "50px";
	  	  buttons[x][y].domNode.onclick = action;
	  	  buttons[x][y].domNode.onclick = action.bind(null,x,y);
	  	  container.appendChild(buttons[x][y].domNode);
		}
	  container.appendChild(document.createElement("br"));
        }

  var aiButton = document.createElement("button");
  aiButton.innerHTML = "Let AI go first";
  aiButton.onclick = action;
  aiButton.onclick = action.bind(null,-1,-1);
  refreshDiv.appendChild(aiButton);
}

window.addEventListener("load", onLoad);
