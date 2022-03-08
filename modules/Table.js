function CreateTableAsLink(rowCount, columnCount, w, pos, ID)
{
    var h = w * rowCount / columnCount;
    var task  = document.createElement('table');
    
    task.style = "border-spacing: 0; line-height: 0; border-collapse: collapse; width:"+ w + "px; height:" + h + "px;";
    
    for(var i = 0; i < rowCount; i++)
    {
        var tr = task.insertRow();
        for(var j = 0; j < columnCount; j++)
        {
            var num = i * columnCount + j;
            var td = tr.insertCell();
            var image = document.createElement('img');
            
            image.src = "pics/" + pos[num] + ".png";
            image.style = "width:" +  w/columnCount + "px; height:" +  h/rowCount + "px;";
            var a = document.createElement('a');
            a.href = "task?task=" + pos + "&columnCount=" + columnCount + "&rowCount=" + rowCount;
            a.classList.add("link_internal");
            a.appendChild(image);
            td.appendChild(a);
        }
    }   
    document.getElementById(ID).appendChild(task);
}

function CreateTable(rowCount, columnCount, w, pos, ID)
{
    var h = w * rowCount / columnCount;
    var task  = document.createElement('table');
    task.style = "border-spacing: 0; line-height: 0; border-collapse: collapse; width:"+ w + "px; height:" + h + "px;";

    for(var i = 0; i < rowCount; i++)
    {
        var tr = task.insertRow();
        for(var j = 0; j < columnCount; j++)
        {
            var num = i * columnCount + j;
            var td = tr.insertCell();
            var image = document.createElement('img');
            image.src = "pics/" + pos[num] + ".png";
            image.style = "width:" +  w/columnCount + "px; height:" +  h/rowCount + "px;";
            td.appendChild(image);
        }
    }   
    document.getElementById(ID).appendChild(task);
    //body.appendChild(task);
}

String.prototype.replaceAt = function(index, replacement) {
    return this.substr(0, index) + replacement + this.substr(index + replacement.length);
}

function getNewPos(pos, columnCount, dir)
{
    var i = 0;
    while ((pos[i] != 'p') && (pos[i] != 'q'))
    i++;
    var to;
    var toto;
    var free = 'e';
    if (pos[i] == 'q') free = 'g';
    switch(dir)
    {
        case "left": to = i - 1; toto = to - 1; break;
        case "right": to = i + 1; toto = to + 1; break;
        case "up": to = i - columnCount; toto = to - columnCount; break;
        case "down": to = i + columnCount; toto = to + columnCount; break;
    }
    
    if (pos[to] == 'w') return pos;
    if (pos[to] == 'e')
    {
        pos = pos.replaceAt(to, 'p');
        pos = pos.replaceAt(i, free);
        return pos;
    }
    if (pos[to] == 'g')
    {
        pos = pos.replaceAt(to, 'q');
        pos = pos.replaceAt(i, free);
        return pos;
    }
    if (pos[to] == 'b')
    {
        if (pos[toto] == 'e')
        {
            pos = pos.replaceAt(to, 'p');
            pos = pos.replaceAt(i, free);
            pos = pos.replaceAt(toto, 'b');
            return pos;
        }
        if (pos[toto] == 'g')
        {
            pos = pos.replaceAt(to, 'p');
            pos = pos.replaceAt(i, free);
            pos = pos.replaceAt(toto, 'c');
            return pos;
        }
    }
    if (pos[to] == 'c')
    {
        if (pos[toto] == 'e')
        {
            pos = pos.replaceAt(to, 'q');
            pos = pos.replaceAt(i, free);
            pos = pos.replaceAt(toto, 'b');
            return pos;
        }
        if (pos[toto] == 'g')
        {
            pos = pos.replaceAt(to, 'q');
            pos = pos.replaceAt(i, free);
            pos = pos.replaceAt(toto, 'c');
            return pos;
        }
    }
    return pos;
}

function isWin(pos)
{
    for (var i = 0; i < pos.length; i++)
    if (pos[i] == 'b') return false;
    return true;
}

function updateCycle(rowCount, columnCount, pos)
{
    var oldPos = pos;
    var currentPos = document.getElementById('currentPos');
    currentPos.value = pos;
    
    function moveLeft()
    {
        oldPos = pos; pos = getNewPos(pos, columnCount, "left");
        DrawNewTable();
    }
    
    function moveRight()
    {
        oldPos = pos; pos = getNewPos(pos, columnCount, "right");
        DrawNewTable();
    }
    
    function moveUp()
    {
        oldPos = pos; pos = getNewPos(pos, columnCount, "up");
        DrawNewTable();
    }
    
    function moveDown()
    {
        oldPos = pos; pos = getNewPos(pos, columnCount, "down");
        DrawNewTable();
    }
    
    function updateTable(e)
    {
    	switch(e.key)
    	{
    		
    		case "ArrowLeft":  oldPos = pos; pos = getNewPos(pos, columnCount, "left");
    			break;
    		case "ArrowUp":  oldPos = pos; pos = getNewPos(pos, columnCount, "up");
    			break;
    		case "ArrowRight":  oldPos = pos; pos = getNewPos(pos, columnCount, "right");
    			break;
    		case "ArrowDown":  oldPos = pos; pos = getNewPos(pos, columnCount, "down");
    			break;
    	}
       	
        
        DrawNewTable();
    }
    
    function DrawNewTable()
    {
        var td = document.getElementsByTagName('td');
        for (var i = 0; i < rowCount * columnCount; i++)
        if (pos[i] != oldPos[i])
        {
            var w = document.getElementsByTagName('table')[0].offsetWidth;
            var h = w * rowCount / columnCount;
            td[i].innerText = "";
            var image = document.createElement('img');
                image.src = "pics/" + pos[i] + ".png";
                image.style = "width:" +  w/columnCount + "px; height:" +  h/rowCount + "px;";
                td[i].appendChild(image);
        }
        currentPos.value = pos;
    }
        
    addEventListener("keydown", updateTable);
    var left = document.getElementById("left");
    left.addEventListener("click", moveLeft);
    var right = document.getElementById("right");
    right.addEventListener("click", moveRight);
    var up = document.getElementById("up");
    up.addEventListener("click", moveUp);
    var down = document.getElementById("down");
    down.addEventListener("click", moveDown);
}