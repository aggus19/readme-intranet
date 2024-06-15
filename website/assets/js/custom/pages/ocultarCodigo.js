document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
    });
    
    document.onkeydown = function(e) {
    if (e.ctrlKey &&
            (e.keyCode === 85 )) {
            return false;
        }
    };