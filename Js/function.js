function hideClass(name){
    let className=document.querySelector("."+name);
    className.style.display="none";
}

function fill(oldHtml, newHtml){
    const parser = new DOMParser();
    const oldDoc = parser.parseFromString(oldHtml, 'text/html');
    const newDoc = parser.parseFromString(newHtml, 'text/html');

    const oldContent = oldDoc.getElementById('content');
    const newContent = newDoc.getElementById('content');

    // Merge the content by appending new elements from the new content
    while (newContent.firstChild) {
        oldContent.appendChild(newContent.firstChild);
    }

    // Serialize the merged content back to a string
    const mergedHTML = new XMLSerializer().serializeToString(oldDoc);
    return mergedHTML;
}

function placeSuggestion(namepost){
    const name=".suggest"+namepost;
    let input=document.querySelector("input[name='"+namepost+"']");
    const suggestlist=document.querySelector(name);
    const result=document.querySelector(name);
    result.addEventListener('click', function(e){
        const target=e.target.textContent.trim();
        input.value=target;
        suggestlist.innerHTML="";
    });
}
