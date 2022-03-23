function Injector(options) {

	/**
	 * Local variables
	 */
	var containerNode;
	var currentNode;
	var scripts = [];

	/**
	 * Check config and set up local variables.
	 */
	var init = function() {
		options = mergeProperties(options || {}, {
			'container': document.body,
			'sibling': null
		});
		
		containerNode = options.container;
		currentNode = options.sibling;
	};

	/**
	 * Merge properties of two objects and return a new combined object.
	 */
	var mergeProperties = function(options, defaults) {
		var combined = {};
		for (var name in defaults) {
			if (!defaults.hasOwnProperty(name)) {
				continue;
			} else if (typeof options[name] == 'undefined') {
				combined[name] = defaults[name];
			} else {
				combined[name] = options[name];
			}
		}
		return combined;
	};

	/**
	 * Fire onload events.
	 */
	var fireLoadEvents = function() {
		var load;
		if (document.createEvent) {
			load = document.createEvent('HTMLEvents');
			load.initEvent('load', false, true);
			window.dispatchEvent(load);
		} else if (document.createEventObject) {
			load = document.createEventObject();
			document.body.fireEvent('onload', load);
		}
	};

	/**
	 * Replaces document.write
	 */
	var documentWrite = function(html) {
		appendHtml(html);
	};

	/**
	 * Create temporary node and inject HTML.
	 */
	var createTemp = function(html) {
		var temp = document.createElement('div');

		if (typeof html == 'object' && html.parentNode) {
			temp.appendChild(html);
		} else if (typeof html == 'object' && html.length) {
			while (html.length) {
				temp.appendChild(html[0]);
			}
		} else {
			//IE7 refuses to work with all empty nodes. Ensure the
			//first node has text, then remove it.
			temp.innerHTML = '<span>.</span>' + html;
			temp.removeChild(temp.childNodes[0]);
		}

		return temp;
	};

	/**
	 * Append HTML at current position.
	 */
	var appendHtml = function(html) {
		var temp = createTemp(html);

		replaceScripts(temp);
		
		var nodes = temp.childNodes;
		while (nodes.length) {
			appendNode(nodes[0]);
		}
	};

	/**
	 * Append a node at current position.
	 *
	 * Called by appendHtml()
	 */
	var appendNode = function(node) {
		if (currentNode) {
			currentNode.parentNode.insertBefore(node, currentNode.nextSibling);
		} else {
			containerNode.appendChild(node);
		}
		currentNode = node;
	};

	/**
	 * Remove all script children and replace with placeholders.
	 *
	 * Keep list of replaced nodes in `scripts` variable.
	 */
	var replaceScripts = function(node) {
		var nodes = node.getElementsByTagName('script');

		// We want new scripts to load in order, but before other scripts.
		// Iterate backwards and push onto front of scripts array.
		for (var i = nodes.length - 1; i >= 0; i--) {
			(function() {
				var node = nodes[i];
				var placeholder = document.createComment('Script placeholder');

				node.parentNode.insertBefore(placeholder, node);
				node.parentNode.removeChild(node);

				scripts.unshift({
					placeholder: placeholder,
					node: node
				});
			})();
		}
	};

	/**
	 * Append script nodes after their placeholders.
	 *
	 * Called after all other functions, before we return to client code.
	 */
	var restoreScripts = function(scripts, complete) {
		
		var restoreScript = function() {
			if (scripts.length) {
				var script = scripts.shift();
				currentNode = script.placeholder;

				// External or inline script?				
				if (script.node.src) {
					var node = document.createElement('script');
					node.type = 'text/javascript';
					node.src = script.node.src;
				    addScriptListeners(node, restoreScript);
				    script.placeholder.parentNode.insertBefore(node, script.placeholder);
				} else if (script.node.innerHTML) {
					evalInline(script.node.innerHTML);
					restoreScript();
				} else {
					restoreScript();
				}
			} else {
				complete();
			}
		};

		restoreScript();
	};

	/**
	 * Listen for onload or onerror events.
	 */
	var addScriptListeners = function(node, func) {
		if (node.addEventListener) {
			node.addEventListener('error', func, true);
			node.addEventListener('load', func, true);
		} else if (node.attachEvent) {
			node.attachEvent('onerror', func, true);
			node.attachEvent('onload', func, true);
			node.attachEvent('onreadystatechange', function() {
				if (node.readyState == 'complete' || node.readyState == 'loaded') {
					func();
				}
			});
		} else {
			throw Error("Failed to attach listeners to script.");
		}
	};


	/**
	 * Evaluate JS snippet.
	 */
	var evalInline = function(script) {
		try {
			eval(script);
		} catch (e) {
			// Don't propagate up the stack
		}
	};

	/**
	 * Wrap DOM modifying function that is being exposed externally.
	 *
	 * This makes sure that while we are internal functions, document.write is
	 * remapped.
	 */
	var expose = function(func) {
		return function() {
			var self = this;
			var temp = document.write;
			
			document.write = documentWrite;
			func.apply(this, arguments);
			
			restoreScripts(scripts, function() {
				document.write = temp;
				self.oncomplete.call();
			});
		};
	};

	/**
	 * Callback
	 */
	this.oncomplete = function() {
		
	};

	/**
	 * Evaluate JS code in the current position.
	 */
	this.eval = expose(function(script) {
		evalInline(script);
	});

	/**
	 * Insert HTML into container.
	 */
	this.insert = expose(function(html) {
		appendHtml(html);
	});

	/**
	 * Set our current node scripts should execute in the context of.
	 */
	this.setContainer = function(container) {
		if (container) {
			containerNode = container;
		}
	};

	/**
	 * Set the sibling node scripts should be run AFTER.
	 */
	this.setSibling = function(sibling) {
		if (sibling) {
			currentNode = sibling;
			containerNode = sibling.parentNode;
		}
	};

	init();
}
      
function btnCheckOnClick() { // обработчик отправки решения
    const searchString = new URLSearchParams(window.location.search);

    let json = JSON.stringify({
      currentPos: document.getElementById("currentPos").getAttribute("value"),
      startPos: searchString.get("task")
    });

    SendPostRequest("", json, "taskAnswer");
}

function btnSortOnClick() { // обработчик сортировки отзывов
    let radioTime = document.getElementById("radioTime");
    let radioMark = document.getElementById("radioMark");
    let radioChecked = radioTime.cheched ? radioTime : radioMark;

    let json = JSON.stringify({
      sort: radioChecked.getAttribute("value"),
    });

    SendPostRequest("", json, "review");
}

function btnReviewOnClick() { // обработчик отправки отзыва
    let radio1 = document.getElementById("radio1");
    let radio2 = document.getElementById("radio2");
    let radio3 = document.getElementById("radio3");
    let radio4 = document.getElementById("radio4");
    let radio5 = document.getElementById("radio5");
                
    let radioChecked = radio1;
    if (radio2.checked) radioChecked = radio2;
    if (radio3.checked) radioChecked = radio3;
    if (radio4.checked) radioChecked = radio4;
    if (radio5.checked) radioChecked = radio5;
    
    let json = JSON.stringify({
      mark: radioChecked.getAttribute("value"),
      review: document.getElementById("reviewArea").value,
      reviewPic: document.getElementById("reviewFile").getAttribute("value"),
      MAX_FILE_SIZE: document.getElementById("maxSize").getAttribute("value"),
    });

    SendPostRequest("", json, "review");
}

function btnEnterOnClick() { // обработчик авторизации
    let json = JSON.stringify({
      login: document.getElementById("editLogin").value,
      password: document.getElementById("editPassword").value,
      enter: document.getElementById("btnEnter").value,
    });
    
    SendPostRequest("", json, "enter");
}

function btnRegistrationOnClick() { // обработчик регистрации
    let json = JSON.stringify({
      login: document.getElementById("editLogin").value,
      password: document.getElementById("editPassword").value,
      registration: document.getElementById("btnRegistration").value,
    });

    SendPostRequest("", json, "enter");
}

function btnExitOnClick() { // обработчик отправки отзыва
    let json = JSON.stringify({
      exit: document.getElementById("btnExit").value,
    });
    
    SendPostRequest("", json, "enter");
}

var links = null; //Создаём переменную, в которой будут храниться ссылки

var loaded = true; //Переменная, которая обозначает, загрузилась ли страница

var data = //Данные о странице
{
    body: "",
    link: "",
    login: "",
};

var page = //Элементы, текст в которых будет меняться
{
    body: document.getElementById("body")
};

//console.log(page.body)
OnLoad();

function OnLoad()
{
    //console.log("OnLoad")
    var link = window.location.pathname; //Ссылка страницы без домена
    LinkClick(link);
}

function InitLinks()
{
    //console.log("InitLinks")
    links = document.getElementsByClassName("link_internal"); //Находим все ссылки на странице
    
    for (var i = 0; i < links.length; i++)
    {
   	 //Отключаем событие по умолчанию и вызываем функцию LinkClick
   	 links[i].onclick = function (e)
   	 {
   		 e.preventDefault();
   		 LinkClick(e.currentTarget.getAttribute("href"));
   		 return false;
   	 };
    }
}

function LinkClick(href)
{
    //console.log(href);
    let props = href.split("/")[0].split("?");
    let args = href.split("?")[1];
    let query = "";
    switch(props[0])
    {
     case "": 
   	 case "index": query += "?page=index"; break;
   	 case "play": query += "?page=play"; break;
   	 case "review": query += "?page=review"; break;
   	 case "task": query += "?page=task"; break;
   	 case "enter": query += "?page=enter"; break;
   	 case "profile": query += "?page=profile"; break;
    }
    if (args != undefined) query += "&" + args;
    SendRequest(query, href);
}

function SendRequest(query, link)
{
    //console.log("SendRequest " + query + " " + link)
    
    let xhr = new XMLHttpRequest(); //Создаём объект для отправки запроса

    xhr.open("GET", "/SPA.php" + query, true); //Открываем соединение

    xhr.onreadystatechange = function() //Указываем, что делать, когда будет получен ответ от сервера
    {
       	 if (xhr.readyState != 4) return; //Если это не тот ответ, который нам нужен, ничего не делаем
    
       	 //Иначе говорим, что сайт загрузился
       	 loaded = true;
    
         switch (xhr.status) {
             case 200: GetData(JSON.parse(xhr.responseText), link); return;
             case 401: LinkClick("enter"); return;
             default: alert("Loading error! Try again later."); return;
         }
    }

    loaded = false; //Говорим, что идёт загрузка

    //Устанавливаем таймер, который покажет сообщение о загрузке, если она не завершится через 2 секунды
    //setTimeout(ShowLoading, 2000);
    xhr.send(); //Отправляем запрос
}

function SendPostRequest(query, body, link)
{
    //console.log("SendRequest " + query + " " + link)
    
    let xhr = new XMLHttpRequest(); //Создаём объект для отправки запроса

    loaded = false; //Говорим, что идёт загрузка
    setTimeout(ShowLoading, 2000);
    
    xhr.open("POST", "/SPA.php" + query, true); //Открываем соединение
    xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
    
    xhr.onreadystatechange = function() //Указываем, что делать, когда будет получен ответ от сервера
    {
   	 if (xhr.readyState != 4) return; //Если это не тот ответ, который нам нужен, ничего не делаем

   	 //Иначе говорим, что сайт загрузился
   	 loaded = true;

         switch (xhr.status) {
             case 200: GetData(JSON.parse(xhr.responseText), link); return;
             case 401: LinkClick("enter"); return;
             default: alert("Loading error! Try again later."); return;
         }
    }

    xhr.send(body); //Отправляем запрос
}

function GetData(response, link) //Получаем данные
{
    //console.log("GetData " + response + " link")
    
    data =
    {
   	 body: response.body,
   	 link: link,
   	 login: response.login,
    };

    UpdatePage(); //Обновляем контент на странице
}

function ShowLoading()
{
    console.log("ShowLoading")
    
    if(!loaded) //Если страница ещё не загрузилась, то выводим сообщение о загрузке
    {
   	 page.body.innerHTML = "<h1>Loading...</h1>";
    }
}

function UpdatePage() //Обновление контента
{
    //console.log("UpdatePage");
    page.body.innerHTML = "";
	var injector = new Injector({container: page.body});
	injector.insert(data.body);
		
	injector.oncomplete = function() {
	    console.log('All scripts inserted');
	}	
    
    window.history.pushState(data.body, data.title, data.link); //Меняем ссылку
    InitLinks(); //Инициализируем новые ссылки
    
    let refEnter = document.getElementById("refEnter");
    if (data.login)
    {
        refEnter.href = "profile";
        refEnter.innerHTML = data.login;
    }
    else
    {
        refEnter.href = "enter";
        refEnter.innerHTML = "Войти";
    }
}