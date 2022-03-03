// by Alexey Zapromyotov (c) 2019/2022

        function showMazeGfx (mazePassed,targetId,lang) {
          //here we are going to display the maze table/array
          //const mazeDiv = document.getElementById("mazeMap");
          var mazeDiv = document.getElementById(targetId);
          // var message = "";
          // if (lang === "FRA") {
          //   message = "Vous etes ici:";
          // } else {
          //   message = "You are here:";
          // }
          //mazeDiv.innerHTML = "<span class='scoreText-container'>"+ message +"</span>"
          mazeDiv.innerHTML = makeTableHTMLGfx(mazePassed);
          // document.getElementById(mazePassed).className = "mazeContainerLeft";
            //mazeDiv.innerHTML = `${numCorrect} out of ${myQuestions.length}`;
        }

        function makeTableHTMLGfx(mazePassed) {
          var mazeDoorMap = mazePassed.doorsMAP;
          var mazeRoomRoleMap = mazePassed.initMAP;
            var result = "<pre><table id='tableMiniMap'>";
            var resultStr ="";
            for(var i=0; i<mazeDoorMap.length; i++) {
                result += "<tr>";
                for(var j=0; j<mazeDoorMap[i].length; j++){
                    //result += "<td>"+mazeDoorMap[i][j]+"</td>";
                    var obj = new Object(mazeDoorMap[i][j]);
                    for(var key in obj)
                    {
                      var value = obj[key];
                      resultStr += (key.toLowerCase() + value + '');
                    }
                    tabCellXId = 'y' + i + 'x' + j;                    
                    // console.log("==> mazeRoomRoleMap[i][j] = " , mazeRoomRoleMap[i][j]);
                    if (mazeRoomRoleMap[i][j] == 4) {
                        result += '<td class="miniMapTDFinalLoc" id="' 
                              + tabCellXId + '"><div class="divMinMapTD"><img src="./jpg/minimap/'
                              + resultStr +'.jpg" alt="[]" height="30" width="40"></div></td>';
                    } else if (mazeRoomRoleMap[i][j] == 5) {
                      result += '<td class="miniMapTDStartLoc" id="' 
                            + tabCellXId + '"><div class="divMinMapTD"><img src="./jpg/minimap/'
                            + resultStr +'.jpg" alt="[]" height="30" width="40"></div></td>';
                    } else {
                        result += '<td class="miniMapTD" id="' 
                              + tabCellXId + '"><div class="divMinMapTD"><img src="./jpg/minimap/' + resultStr + '.jpg" alt="[]" height="30" width="40"';
                        result += '<a ';
                        result += 'onclick="playerCoordChange(' + i + ',' + j + ');return false;">';
                        result += '</a>';
                        
                        
                        // $('<img src="./jpg/minimap/'
                        //       + resultStr +'.jpg" alt="[]" height="30" width="40">'
                        //       ).click(function(){ playerCoordChange(i,j); return false; }) 
                        result += '</div></td>';
                        
                    }
                    // $('#myLink').click(function(){ MyFunction(); return false; });
                   
                    resultStr = "";
                }
                result += '';
            }
            result += "</table></pre>";
            return result;
        }

        function playerCoordChange(x,y) {
          //import { playerCoordChange } from 'game.js';
      console.log("playerCoordChange: x= ",x, " y= ", y);
      globalPlayerXY.x = x;
      globalPlayerXY.y = y;
      App.prototype.x = x;
      App.prototype.x = y;
  }

