<template>
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-12">
            <div class="card bg-secondary">
                <div class="card-body">
                    <div v-if="error.length" class="alert alert-danger">
                        {{ error }}
                    </div>

                    <div>
                        <h1 class="pb-1">Create a New Quiz</h1>
                        <p>Please enter your quiz title below. When finished continue to the next step.</p>
                    </div>

                    <form action="/quiz-create/quizTitlePost" method="POST">
                        <div class="form-group">
                            <label for="quizTitleInput">Quiz Title</label>
                            <input required id="quizTitleInput" type="text" name="quizTitle" placeholder="Quiz Title"
                                   class="form-control" v-model="quizTitleInputValue">
                        </div>
                    </form>

                    <button type="submit" class="btn btn-primary" @click="startQuizCreation" :disabled="!canStartQuizCreation">Submit</button>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                quizTitleInputValue: '',
                error: '',
                loading: false,
            }
        },

        methods: {
            startQuizCreation() {
                this.error = '';

                if (!this.canStartQuizCreation) {
                    return;
                }

                let data = new FormData;
                data.append('quizTitle', this.quizTitleInputValue);

                this.loading = true;

                axios.post('/quiz-create/start', data)
                    .then((response) => {
                        if (response.data.error) {
                            this.error = response.data.error;
                            return;
                        }

                        this.$emit('quiz-creation-started', {
                            'newQuizTitle': this.quizTitleInputValue,
                            'newQuizId': response.data.newQuizId
                        });

                    }).finally(() => {
                    this.loading = false;
                });
            }
        },

        computed: {
            canStartQuizCreation() {
                return this.quizTitleInputValue.length > 0;
            },
        },
    }
</script>