<template>
    <div class="row h-100 justify-content-center align-items-center">

        <div class="col-12 mb-2">
            <div class="card bg-secondary">
                <div class="card-body">
                    <div>
                        <h1 class="pb-1">Create a new Question</h1>
                        <p>Add new questions for Your quiz "{{ quizName }}."</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card bg-secondary">
                <div class="card-body">
                    <span class="float-right" style="cursor: pointer">X</span>

                    <h3 class="pb-1">Question #1</h3>

                    <form action="/quiz-create/quizQuestionPost" method="POST">
                        <div class="form-group">
                            <label for="questionTextInput">Question Text</label>
                            <input required id="questionTextInput" type="text" name="questionText"
                                   placeholder="Question text"
                                   class="form-control" v-model="questionTextInputValue">
                        </div>

                        <div class="form-group">
                            <label for="answerTextInput">Answers</label>
                            <input required type="text" id="answerTextInput" name="answerText"
                                   placeholder="Answer" class="form-control">
                            <button class="btn btn-secondary mt-2">Add new answer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-primary">Add another question</button>
        </div>

    </div>
</template>

<script>
    export default {
        props: {
            'quizName': {
                required: true,
            },
        },

        data() {
            return {
                questionTextInputValue: '',
                error: '',
                loading: false,
            }
        },
    }
</script>