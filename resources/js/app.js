import "./bootstrap";
import "../css/app.css";
import { createApp } from "vue/dist/vue.esm-bundler";
import Card from "./components/Card.vue";
import CreateQuestion from "./components/CreateQuestion.vue";
import Category from "./components/Category.vue";
import Quiz from "./components/Quiz.vue";
import axios from "axios";

axios.defaults.baseURL = "http://localhost/api/";

const app = createApp({
    components: {
        card: Card,
        createQuestion: CreateQuestion,
        category: Category,
        quiz: Quiz,
    },
});

app.mount("#app");
