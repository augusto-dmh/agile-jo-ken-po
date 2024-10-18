import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                lightgreen: "#90ee90",
                lightcoral: "#f08080",
                yellow: "#ffff00",
            },
            backgroundColor: {
                primary: "#353b54",
            },
            boxShadow: {
                "outer-bright": "0 0 30px 0 rgba(255,255,255,0.50)",
            },
        },
    },

    plugins: [forms],
};
