// Disable right click on EVERYTHING
document.addEventListener('contextmenu', e => e.preventDefault());

function blockScreenshot(e) {
    // Prevent Print Screen
    if (e.key === 'PrintScreen' || e.code === 'PrintScreen' || e.keyCode === 44) {
        try { navigator.clipboard.writeText(''); } catch (err) {}
        alert('Screenshots are disabled.');
        e.preventDefault();
        return false;
    }
    
    // Prevent Snipping Tool / Mac Screenshots
    if ((e.ctrlKey || e.metaKey) && e.shiftKey && (e.key === 'S' || e.key === 's')) {
        try { navigator.clipboard.writeText(''); } catch (err) {}
        alert('Screenshots are disabled.');
        e.preventDefault();
        return false;
    }
 
    // Prevent Ctrl+Shift+I / DevTools / F12 / F11
    if (
        (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'i' || e.key === 'J' || e.key === 'j' || e.key === 'C' || e.key === 'c')) ||
        (e.ctrlKey && (e.key === 'U' || e.key === 'u')) ||
        (e.key === 'F12' || e.keyCode === 123) ||
        (e.key === 'F11' || e.keyCode === 122)
    ) {
        e.preventDefault();
        return false;
    }
}

// Bind to both keydown and keyup for broader OS interception
document.addEventListener('keydown', blockScreenshot);
document.addEventListener('keyup', blockScreenshot);
