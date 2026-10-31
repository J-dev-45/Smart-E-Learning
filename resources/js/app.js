import './bootstrap';

import { createApp, ref} from 'vue';

const app = createApp({
    setup() {
        const subjects = ref(window.initialSubjects || []);

        function handleSubjectAdded(newSubject) {
            if (!newSubject) return;

            const exists = subjects.value.some(
                subject => String(subject.id) === String(newSubject.id)
            );

            if (!exists) {
                subjects.value.push(newSubject);
            }
        }

        return {
            subjects,
            handleSubjectAdded
        };
    }
});

app.provide('appData', {
    name: 'smart-eLearning',
    logo: '/images/Components/Logo.png'
});

// ===================================================================================================|ADMIN
// ===================================================================================================|ADMIN
// ===================================================================================================|ADMIN

import Dashboard_Cards from './Vue/Admin/components/Dashboard_Cards.vue'
import Overview from './Vue/Admin/Pages/Overview.vue';
import Users from './Vue/Admin/Pages/Users.vue';
import Bottom_Navigation from './Vue/Admin/components/Bottom_Navigation.vue';
import Left_Navigation from './Vue/Admin/components/Left_Navigation.vue';
import Subjects_Navigation from './Vue/Admin/components/Subjects_Navigation.vue';
import Feedbacks from './Vue/Admin/Pages/Feedbacks.vue';
import Modules from './Vue/Admin/Pages/Modules.vue';
import Questions_Main from './Vue/Admin/Pages/Main/Questions_Main.vue';
import Subjects_Cards_Admin from './Vue/Admin/Pages/Subjects_Cards_Admin.vue';
import Admin_Header from './Vue/Admin/components/Admin_Header.vue';

app.component('dashboard-cards', Dashboard_Cards);
app.component('overview', Overview);
app.component('users-page', Users);
app.component('bottom-navigation', Bottom_Navigation);
app.component('left-navigation', Left_Navigation);
app.component('subjects-navigation', Subjects_Navigation);
app.component('subjects-cards-admin', Subjects_Cards_Admin);
app.component('feedbacks-page', Feedbacks);
app.component('modules', Modules);
app.component('questions-main', Questions_Main);
app.component('admin-header', Admin_Header);

// ===================================================================================================|CLIENT
// ===================================================================================================|CLIENT
// ===================================================================================================|CLIENT

import Subjects_Cards from './Vue/Client/Components/Subjects_Cards.vue';
import Assessment_Form from './Vue/Client/Pages/Assessment_Form.vue';
import Client_Navigation from './Vue/Client/Components/Client_Navigation.vue';
import Quiz_Modules from './Vue/Client/Pages/Quiz_Modules.vue';
import Choose_Module_Header from './Vue/Client/Components/Choose_Module_Header.vue';
import Taking_Pretest_Header from './Vue/Client/Components/Taking_Pretest_Header.vue';
import Assessment_Result from './Vue/Client/Pages/Assessment_Result.vue';
import User_Menu from './Vue/Client/Components/User_Menu.vue';
import CodePlayground from './Vue/Client/Pages/CodePlayground.vue';
import Learn_Header from './Vue/Client/Components/Learn_Header.vue';
import Leaderboard from './Vue/Client/Pages/Leaderboard.vue';
import Module_Activity from './Vue/Client/Pages/Module_Activity.vue';
import Module_Quiz_Buttons from './Vue/Client/Components/Module_Quiz_Buttons.vue';
import Feedback_Form from './Vue/Client/Components/Feedback_Form.vue';
import Student_Profile from './Vue/Client/Components/Student_Profile.vue';

app.component('subjects-card', Subjects_Cards);
app.component('assessment-form', Assessment_Form);
app.component('client-navigation', Client_Navigation);
app.component('quiz-modules', Quiz_Modules);
app.component('choose-module-header', Choose_Module_Header);
app.component('taking-pretest-header', Taking_Pretest_Header);
app.component('assessment-result', Assessment_Result);
app.component('user-menu', User_Menu);
app.component('code-playground', CodePlayground);
app.component('learn-header', Learn_Header)
app.component('leaderboard', Leaderboard);
app.component('module-activity', Module_Activity);
app.component('module-quiz-buttons', Module_Quiz_Buttons);
app.component('feedback-form', Feedback_Form);
app.component('student-profile', Student_Profile);

// | AUTH |===================================================================================================
// | AUTH |===================================================================================================
// | AUTH |===================================================================================================

import Mobile_Login from './Vue/Auth/Mobile_Login.vue';
import Desktop_Login from './Vue/Auth/Desktop_Login.vue';
import Desktop_Register from './Vue/Auth/Desktop_Register.vue';
import Mobile_Register from './Vue/Auth/Mobile_Register.vue';
import Desktop_Forgot_Password from './Vue/Auth/Desktop_Forgot_Password.vue';
import Desktop_Verify from './Vue/Auth/Desktop_Verify.vue';
import Mobile_Verify from './Vue/Auth/Mobile_Verify.vue';

app.component('mobile-login', Mobile_Login);
app.component('desktop-login', Desktop_Login);
app.component('desktop-register', Desktop_Register);
app.component('mobile-register', Mobile_Register);
app.component('desktop-forgot-password', Desktop_Forgot_Password);
app.component('desktop-verify', Desktop_Verify);
app.component('mobile-verify', Mobile_Verify);

// ===================================================================================================|GLOBAL
// ===================================================================================================|GLOBAL
// ===================================================================================================|GLOBAL

import Loading_Screen from './Vue/Global/Loading_Screen.vue';
app.component('loading-screen', Loading_Screen);



app.mount('#app');