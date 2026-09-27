(function () {
    'use strict';

    var canvas = document.querySelector('[data-bg-globe]');
    if (!canvas || !canvas.getContext) { return; }

    var ctx = canvas.getContext('2d');
    var calm = window.matchMedia('(prefers-reduced-motion: reduce)');
    var glyphs = ['₿', 'Ξ', '₮', '◎', 'Ł', 'Ð', '₳'];
    var total = 110;
    var nodes = [];
    var links = [];
    var width = 0;
    var height = 0;
    var radius = 0;
    var centerX = 0;
    var centerY = 0;
    var frame = 0;
    var running = false;

    for (var i = 0; i < total; i++) {
        var phi = Math.acos(-1 + (2 * i) / total);
        var theta = Math.sqrt(total * Math.PI) * phi;
        nodes.push({
            x: Math.cos(theta) * Math.sin(phi),
            y: Math.sin(theta) * Math.sin(phi),
            z: Math.cos(phi),
            glyph: glyphs[i % glyphs.length],
            teal: i % 3 === 0,
            speed: Math.random() * 0.02 + 0.015,
            offset: Math.random() * Math.PI * 2
        });
    }

    for (var a = 0; a < total; a++) {
        for (var b = a + 1; b < total; b++) {
            var dx = nodes[a].x - nodes[b].x;
            var dy = nodes[a].y - nodes[b].y;
            var dz = nodes[a].z - nodes[b].z;
            var dist = Math.sqrt(dx * dx + dy * dy + dz * dz);
            if (dist < 0.42) { links.push([a, b, 1 - dist / 0.42]); }
        }
    }

    function size() {
        var ratio = Math.min(window.devicePixelRatio || 1, 2);
        width = window.innerWidth;
        height = window.innerHeight;
        canvas.width = Math.round(width * ratio);
        canvas.height = Math.round(height * ratio);
        canvas.style.width = width + 'px';
        canvas.style.height = height + 'px';
        ctx.setTransform(ratio, 0, 0, ratio, 0, 0);

        var wide = width > 900;
        radius = wide ? Math.min(width * 0.25, height * 0.4) : width * 0.46;
        centerX = wide ? width * 0.76 : width * 0.78;
        centerY = wide ? height * 0.56 : height * 0.64;
    }

    function draw() {
        var turn = frame * 0.0022;
        var tilt = 0.35 + Math.sin(frame * 0.0007) * 0.08;
        var cosY = Math.cos(turn);
        var sinY = Math.sin(turn);
        var cosX = Math.cos(tilt);
        var sinX = Math.sin(tilt);
        var points = [];

        ctx.clearRect(0, 0, width, height);

        for (var i = 0; i < total; i++) {
            var n = nodes[i];
            var x1 = n.x * cosY + n.z * sinY;
            var z1 = -n.x * sinY + n.z * cosY;
            var y2 = n.y * cosX - z1 * sinX;
            var z2 = n.y * sinX + z1 * cosX;
            var scale = 2.8 / (2.8 - z2);
            points.push({
                x: centerX + x1 * radius * scale,
                y: centerY + y2 * radius * scale,
                depth: (z2 + 1) / 2,
                node: n
            });
        }

        ctx.lineWidth = 1;
        for (var l = 0; l < links.length; l++) {
            var p = points[links[l][0]];
            var q = points[links[l][1]];
            var alpha = (0.04 + ((p.depth + q.depth) / 2) * 0.28) * links[l][2];
            ctx.strokeStyle = 'rgba(106, 228, 255, ' + alpha.toFixed(3) + ')';
            ctx.beginPath();
            ctx.moveTo(p.x, p.y);
            ctx.lineTo(q.x, q.y);
            ctx.stroke();
        }

        points.sort(function (m, k) { return m.depth - k.depth; });

        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        for (var j = 0; j < points.length; j++) {
            var pt = points[j];
            var pulse = (Math.sin(frame * pt.node.speed + pt.node.offset) + 1) / 2;
            var fontSize = 8 + pt.depth * 10 + pulse * 3;
            var glow = (0.18 + pt.depth * 0.72) * (0.6 + pulse * 0.4);
            ctx.font = '700 ' + fontSize.toFixed(1) + 'px "Source Sans 3", "Segoe UI Symbol", sans-serif';
            ctx.fillStyle = pt.node.teal
                ? 'rgba(52, 237, 179, ' + glow.toFixed(3) + ')'
                : 'rgba(106, 228, 255, ' + glow.toFixed(3) + ')';
            ctx.fillText(pt.node.glyph, pt.x, pt.y);
        }
    }

    function loop() {
        if (!running) { return; }
        frame += 1;
        draw();
        window.requestAnimationFrame(loop);
    }

    function start() {
        if (running || calm.matches) { return; }
        running = true;
        window.requestAnimationFrame(loop);
    }

    var timer;
    window.addEventListener('resize', function () {
        clearTimeout(timer);
        timer = setTimeout(function () { size(); draw(); }, 150);
    });

    document.addEventListener('visibilitychange', function () {
        if (document.hidden) { running = false; } else { start(); }
    });

    size();
    draw();
    start();
}());
