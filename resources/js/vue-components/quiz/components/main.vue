<template>
    <div>

        <div class="container h-100 mt-5" v-if="currentStep === 1">
            <div class="row mb-3">
                <div class="col-12">
                    <quiz-start :name="name"
                                :quizzes="quizzes"
                                @quiz-started="onQuizStarted">
                    </quiz-start>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <quiz-history :attempts="attempts" :quizzes="quizzes" >
                    </quiz-history>
                </div>
            </div>
        </div>


        <quiz-questions :current-quiz="currentQuiz" :result="result" :current-question="currentQuestion" @results-received="onResultsReceived" v-else-if="currentStep === 2">
        </quiz-questions>

        <quiz-results :current-quiz="currentQuiz" :result="result" v-else-if="currentStep === 3" @quiz-finished="onQuizFinished">
        </quiz-results>

        <div v-else class="container" style="height:70vh;">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-12">
                    <div class="card border-light">
                        <div class="card-body text-center">
                            <button class="btn btn-danger" @click="currentStep = 1">
                                Something went wrong. Return to start.
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import QuizStartComponent from './quiz-start.vue';
    import QuizQuestionsComponent from './quiz-questions.vue';
    import QuizResultsComponent from './quiz-results.vue';
    import QuizHistoryComponent from './quiz-history.vue';
    import {Quiz} from './../models/quiz.models.js';
    import {Attempt} from "../models/quiz.models";

    export default {
        components: {
            'quiz-start': QuizStartComponent,
            'quiz-questions': QuizQuestionsComponent,
            'quiz-results': QuizResultsComponent,
            'quiz-history': QuizHistoryComponent
        },

        props: {
            name: {
                required: true,
            },

            quizzesProp: {
                default: [],
                required: true,
            },

            attemptsProp: {
                default: [],
                required: true,
            },
        },

        created() {
            this.quizzes = this.quizzesProp.map((quizDatum) => {
                return Quiz.fromArray(quizDatum);
            });

            this.attempts = this.attemptsProp.map((attemptDatum) => {
                return Attempt.fromArray(attemptDatum);
            });
        },

        data() {
            return {
                /** @type {Array<Quiz>} */
                quizzes: [],

                /** @type {Array<Attempt>} */
                attempts: [],

                /** @type {Number} **/
                currentStep: 1,

                /** @type {?Number} */
                currentQuiz: null,

                /** @type {?Number} */
                currentQuestion: null,

                /** @type {?Result} */
                result: null,
            }
        },

        methods: {
            /**
             * @param {{quizId: number, firstQuestion Question}} emittedData
             */
            onQuizStarted(emittedData) {
                let quizId = emittedData.quizId;

                this.currentQuiz = this.quizzes.find((quiz) => {
                    return quiz.id === quizId;
                });

                this.currentQuestion = emittedData.firstQuestion;

                this.currentStep++;
            },

            /**
             *
             * @param {Result} emittedResult
             */
            onResultsReceived(emittedResult) {
                this.result = emittedResult;

                this.currentStep++;

                this.currentQuestion = null;
            },

            onQuizFinished() {
                this.currentStep = 1;

                this.currentQuiz = null;
                this.result = null;
            },
        }
    }
</script>