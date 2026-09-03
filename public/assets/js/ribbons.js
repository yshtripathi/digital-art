/**
 * =======================================================
 * Flowing Ribbons Background Effect (Gallery Theme)
 * =======================================================
 */
(function() {
    // Create and inject the canvas
    const canvas = document.createElement('canvas');
    canvas.id = 'ag-flowing-ribbons';
    canvas.style.position = 'fixed';
    canvas.style.top = '0';
    canvas.style.left = '0';
    canvas.style.width = '100vw';
    canvas.style.height = '100vh';
    canvas.style.zIndex = '-1';
    canvas.style.pointerEvents = 'none'; // Ensure clicks pass through to the actual site
    document.body.appendChild(canvas);

    const ctx = canvas.getContext('2d');
    let time = 0;
    let animationFrameId;
    const mouse = { x: -1000, y: -1000, isDown: false };
    let waveDisturbances = [];
    
    // Theme Config (Darker lines for higher visibility)
    const lineColor = 'rgba(0, 0, 0, 0.25)'; 
    const animationSpeed = 0.3;

    function resizeCanvas() {
        const dpr = window.devicePixelRatio || 1;
        canvas.width = window.innerWidth * dpr;
        canvas.height = window.innerHeight * dpr;
        ctx.setTransform(1, 0, 0, 1, 0, 0);
        ctx.scale(dpr, dpr);
    }

    function getMouseInfluence(x, y) {
        const dx = x - mouse.x;
        const dy = y - mouse.y;
        const distance = Math.sqrt(dx * dx + dy * dy);
        const maxDistance = 200;
        return Math.max(0, 1 - distance / maxDistance);
    }

    function getWaveDisturbance(x, y, currentTime) {
        let totalDisturbance = 0;
        waveDisturbances.forEach(disturbance => {
            const age = currentTime - disturbance.time;
            const maxAge = 3000;
            if (age < maxAge) {
                const dx = x - disturbance.x;
                const dy = y - disturbance.y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                const waveRadius = (age / maxAge) * 400;
                const waveWidth = 80;
                if (Math.abs(distance - waveRadius) < waveWidth) {
                    const waveStrength = (1 - age / maxAge) * disturbance.intensity;
                    const proximityToWave = 1 - Math.abs(distance - waveRadius) / waveWidth;
                    totalDisturbance += waveStrength * proximityToWave * Math.sin((distance - waveRadius) * 0.1);
                }
            }
        });
        return totalDisturbance;
    }

    function deform(x, y, t, progress) {
        const mouseInfluence = getMouseInfluence(x, y);
        const disturbance = getWaveDisturbance(x, y, Date.now());

        const wave1 = Math.sin(progress * Math.PI * 4 + t * 0.01) * 30;
        const wave2 = Math.sin(progress * Math.PI * 7 - t * 0.008) * 15;
        const harmonic = Math.sin(x * 0.02 + y * 0.015 + t * 0.005) * 10;

        const mouseWave = mouseInfluence * Math.sin(t * 0.02 + progress * Math.PI * 2) * 20;
        const disturbanceWave = disturbance * Math.sin(t * 0.015 + progress * Math.PI * 3) * 25;

        return {
            offsetX: wave1 + harmonic + mouseWave + disturbanceWave,
            offsetY: wave2 + mouseWave * 0.5 + disturbanceWave * 0.7,
        };
    }

    function animate() {
        if (!ctx) return;
        const currentTime = Date.now();
        time += animationSpeed;

        const width = window.innerWidth;
        const height = window.innerHeight;

        const gridDensity = 30; // Optimized for performance & aesthetic
        const ribbonWidth = width * 1.2; 
        const ribbonOffset = (width - ribbonWidth) / 2;

        ctx.clearRect(0, 0, width, height);

        ctx.strokeStyle = lineColor;
        ctx.lineWidth = 1.5;

        // Vertical lines
        for (let i = 0; i <= gridDensity; i++) {
            const x = ribbonOffset + (i / gridDensity) * ribbonWidth;
            ctx.beginPath();
            for (let j = 0; j <= gridDensity; j++) {
                const progress = (j / gridDensity) * 1.2 - 0.1;
                const y = progress * height;
                const { offsetX, offsetY } = deform(x, y, time, progress);
                if (j === 0) ctx.moveTo(x + offsetX, y + offsetY);
                else ctx.lineTo(x + offsetX, y + offsetY);
            }
            ctx.stroke();
        }

        // Horizontal lines
        for (let j = 0; j <= gridDensity; j++) {
            const progress = (j / gridDensity) * 1.2 - 0.1;
            const y = progress * height;
            ctx.beginPath();
            for (let i = 0; i <= gridDensity; i++) {
                const x = ribbonOffset + (i / gridDensity) * ribbonWidth;
                const { offsetX, offsetY } = deform(x, y, time, progress);
                if (i === 0) ctx.moveTo(x + offsetX, y + offsetY);
                else ctx.lineTo(x + offsetX, y + offsetY);
            }
            ctx.stroke();
        }

        animationFrameId = requestAnimationFrame(animate);
    }

    window.addEventListener('resize', resizeCanvas);
    window.addEventListener('mousemove', (e) => {
        mouse.x = e.clientX;
        mouse.y = e.clientY;
    });
    window.addEventListener('mousedown', (e) => {
        mouse.isDown = true;
        waveDisturbances.push({ x: e.clientX, y: e.clientY, time: Date.now(), intensity: 2 });
        const now = Date.now();
        waveDisturbances = waveDisturbances.filter(d => now - d.time < 3000);
    });
    window.addEventListener('mouseup', () => { mouse.isDown = false; });

    resizeCanvas();
    animate();
})();
