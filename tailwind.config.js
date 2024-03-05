/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                "dark-primary": "#221D28",
                "dark-blurred": "#2B2634",
                "panel-white": "#F5F4F7",
                "not-white": "#FAFAFC",
                "blue-light": "#2D78C8",
                "orange-light": "#EF3C24",
                "sea-light": "#16BDC8",
                "blue-second-light": "#478AEF",
                "sea-dark": "#00DEEC",
                "orange-dark": "#EB582A",
                "blue-dark": "#79AFFF",
                "green-dark": "#2DFFD9",
                "dark-bg": "#0F073D",
                "on-dark": "rgba(255,255,255, 0.92)",
                "blue-primary": "#2B74E2",
                "primary-dark": "#001A41",
                neutral: "#878889",
                "neutral-lighter": "#F7F9FA",
                "green-primary": "#008A40",
                "red-primary": "#DE3730",
            },
            borderRadius: {
                button: "4px",
            },
            padding: {
                "22px": "22px",
            },
        },
    },
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
    },
};
