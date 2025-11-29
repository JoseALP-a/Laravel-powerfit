<style>
    body {
        background-image: url("{{ asset('Imagenes/PowerFitHome.jpg') }}");
        background-size: cover;
        background-position: center;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #333;
        box-sizing: border-box;
    }

    *, *::before, *::after { box-sizing: inherit; }

    .register-container {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        box-shadow: 0 0 15px rgba(255, 123, 0, 0.5);
        padding: 30px 25px;
        width: 100%;
        max-width: 420px;
        text-align: center;
        position: relative;
        overflow-wrap: break-word; /* evita que el texto se salga */
        word-wrap: break-word;
    }

    .logo-title {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
        flex-wrap: wrap; /* permite que el texto se mueva a otra línea si es necesario */
    }

    .logo-title img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 2px solid #ff7b00;
        padding: 5px;
    }

    .logo-title h2 {
        color: #ff7b00;
        font-weight: 700;
        font-size: 1.6rem;
        margin: 0;
        overflow-wrap: break-word;
    }

    p {
        color: #555;
        margin-bottom: 20px;
        font-size: 0.95rem;
        overflow-wrap: break-word;
    }

    input, button {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border-radius: 8px;
        font-size: 14px;
        box-sizing: border-box;
    }

    input {
        border: 2px solid #ff7b00;
    }

    button {
        background: linear-gradient(90deg, #ff7b00, #ffb347);
        color: white;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 10px;
    }

    button:hover { transform: scale(1.05); }

    .link { margin-top: 15px; font-size: 14px; word-wrap: break-word; }
    .link a { color: #ff7b00; text-decoration: none; font-weight: 500; }
    .link a:hover { text-decoration: underline; }

    .home-button {
        position: absolute;
        top: 10px;
        right: 10px;
        background: white;
        border: 2px solid #ff7b00;
        color: #ff7b00;
        font-weight: 600;
        border-radius: 8px;
        padding: 5px 10px;
        font-size: 0.9rem;
        text-decoration: none;
        transition: 0.3s;
        max-width: 120px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
    .home-button:hover { background: #ff7b00; color: white; }

    .error-message, .alert {
        border-radius: 8px;
        padding: 8px;
        font-size: 0.9rem;
        margin-top: 4px;
        text-align: left;
        overflow-wrap: break-word;
    }

    .error-message {
        background: rgba(255, 102, 0, 0.1);
        color: #d9534f;
        border: 1px solid #ff7b00;
    }

    .alert {
        background: rgba(255, 123, 0, 0.15);
        color: #ff6600;
        border-left: 4px solid #ff7b00;
        margin-bottom: 10px;
    }

    /* 🔹 Responsive */
    @media (max-width: 480px) {
        .register-container { padding: 25px 15px; width: 95%; }
        .logo-title img { width: 40px; height: 40px; }
        .logo-title h2 { font-size: 1.4rem; }
        p { font-size: 0.9rem; }
        .home-button { padding: 4px 8px; font-size: 0.8rem; }
    }

    @media (max-width: 360px) {
        input, button { font-size: 13px; padding: 8px; }
        .link { font-size: 13px; }
    }
</style>
