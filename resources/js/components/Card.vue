<script>
import axios from "axios";

import createQuestion from "./CreateQuestion.vue";
import category from "./Category.vue";
import quiz from "./Quiz.vue";

export default {
    data() {
        return {
            idx: 0,
            selectedAnswer: "",
            correctAnswersCount: 0,
            wrongAnswersCount: 0,
            count: 1,
            startQuiz: false,
            addQuestionScreen: false,
            successMessage: "",
            categoryId: 1,
            questions: [],
            categories: [],
            answers: [],
            answerTypes: [],
        };
    },
    methods: {
        answered(e) {
            this.selectedAnswer = e.target.value;
            if (this.selectedAnswer == this.answers[this.idx].answer) {
                this.correctAnswersCount++;
            } else {
                this.wrongAnswersCount++;
            }
        },
        nextQuestion() {
            this.idx++;
            this.selectedAnswer = "";
            document
                .querySelectorAll("input")
                .forEach((el) => (el.checked = false));
        },
        showResults() {
            this.idx++;
        },
        startQuizMethod(e) {
            // if event not given
            if (isNaN(e)) {
                this.categoryId = e.target.value;
            }
            axios.get(`/get-questions/${this.categoryId}`).then((response) => {
                this.questions = response.data;
                this.count = response.data.length;
            });
            axios.get(`/get-answers/${this.categoryId}`).then((response) => {
                this.answers = response.data;
                this.count = response.data.length;
            });
            this.idx = 0;
            this.selectedAnswer = "";
            this.correctAnswersCount = 0;
            this.wrongAnswersCount = 0;
            this.startQuiz = true;
        },
        getCategories() {
            this.successMessage = "";
            this.startQuiz = false;
            this.addQuestionScreen = false;
        },
        //quizdata
        postQuestion(questionData) {
            console.log(questionData.question);
            axios
                .post("/create", {
                    question: questionData.question,
                    question_category_id: questionData.category.id,
                    answer: questionData.answer,
                    answer_type_id: questionData.type.id,
                    answer_list: questionData.incorrectAnswersList,
                })
                .then((response) => {
                    console.log(response);

                    this.successMessage = response.data.success;
                });
        },
        addQuestion() {
            this.addQuestionScreen = true;
        },
    },
    beforeMount() {
        axios.get("/categories").then((response) => {
            console.log(response.data);
            this.categories = response.data;
        });
        axios.get("/answer-types").then((response) => {
            this.answerTypes = response.data;
        });
    },
    components: {
        createQuestion,
        category,
        quiz,
    },
};
</script>

<template>
    <body class="antialiased text-gray-700 bg-gray-100">
        <div id="app" class="flex w-full justify-center items-center">
            <div class="w-full max-w-xl p-3 h-screen" v-if="startQuiz">
                <h1 class="font-bold text-5xl text-center text-indigo-700">
                    Laravel Quiz
                </h1>
                <quiz
                    @answered="answered"
                    @next-question="nextQuestion"
                    @show-results="showResults"
                    @start-quiz="startQuizMethod"
                    @get-categories="getCategories"
                    :count="this.count"
                    :idx="this.idx"
                    :questions="this.questions"
                    :answers="this.answers"
                    :correctAnswersCount="this.correctAnswersCount"
                    :wrongAnswersCount="this.wrongAnswersCount"
                    :selectedAnswer="this.selectedAnswer"
                    :categoryId="this.categoryId"
                ></quiz>
            </div>
            <div id="create-question" v-else-if="addQuestionScreen">
                <createQuestion
                    @get-categories="getCategories"
                    @post-question="postQuestion"
                    :answer-types="this.answerTypes"
                    :categories="this.categories"
                    :successMessage="this.successMessage"
                ></createQuestion>
            </div>
            <div id="category" v-else class="w-full h-full max-w-xl p-3">
                <category
                    @add-question="addQuestion"
                    @start-quiz="startQuizMethod"
                    :categories="this.categories"
                ></category>
            </div>
        </div>
    </body>
</template>
