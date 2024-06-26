<?php $purchased = $database->query("SELECT * FROM `Purchased` WHERE `userId` = " . $_SESSION['uid'])->fetchAll(2); ?>
<div class="container">
    <div class="learning-right">
        <div class="learning-top">

            <?php

            $userId = $_SESSION['uid']; // Предполагается, что идентификатор пользователя хранится в сессии

            $sql = "SELECT l.id, l.name
        FROM lessons l
        INNER JOIN Purchased cp ON l.courseId  = cp.courseId 
        WHERE cp.userId = :user_id
        AND NOT EXISTS (
            SELECT 1
            FROM homeworks hw
            INNER JOIN peoplesanswers ua ON hw.questionid = ua.question_id AND ua.user_id = cp.userId 
            WHERE hw.lessonId  = l.id
            AND ua.status = 'on_check'
            GROUP BY hw.lessonId
            HAVING COUNT(ua.id) = (
                SELECT COUNT(*)
                FROM homeworks
                WHERE lessonId = hw.lessonId
            )
        )";

            $stmt = $database->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $nextLesson = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>


            <?php if($nextLesson): ?>
                <a href="/?page=homework-q&lessonId=<?=$nextLesson['id']?>" class="next-lesson">
                    <p>СЛЕДУЮЩИЙ УРОК</p>
                    <h3><?= $nextLesson['name'] ?></h3>
                    <span>›</span>

                    <img class="bacg" src="assets/images/catalog/image 1.png" alt="">
                </a>
            <?php endif; ?>



            <div class="nomake-homework">
                <h4>Нерешенное домашнее задание</h4>
                <div class="nomake-homework-info">
                    <img src="assets/images/catalog/image 2.png" alt="">
                    <div class="nomake-homework-text">
                        <div class="nomake-homework-name">
                            <div class="count-learn">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.8398 0.969971H10C9.6875 0.969971 9.38802 1.02856 9.10156 1.14575C8.8151 1.26294 8.5612 1.41919 8.33984 1.6145C8.11849 1.41919 7.86458 1.26294 7.57812 1.14575C7.29167 1.02856 6.99219 0.969971 6.67969 0.969971H0.839844C0.605469 0.969971 0.406901 1.05135 0.244141 1.21411C0.0813802 1.37687 0 1.57544 0 1.80981V14.3098C0 14.5312 0.0813802 14.7232 0.244141 14.886C0.406901 15.0487 0.605469 15.1301 0.839844 15.1301H5.64453C5.86589 15.1301 6.07747 15.1724 6.2793 15.2571C6.48112 15.3417 6.66016 15.4622 6.81641 15.6184L7.75391 16.5559C7.75391 16.5559 7.75716 16.5592 7.76367 16.5657C7.77018 16.5722 7.77344 16.5754 7.77344 16.5754C7.8125 16.6145 7.85156 16.6471 7.89062 16.6731C7.92969 16.6991 7.97526 16.7187 8.02734 16.7317C8.06641 16.7577 8.11523 16.7773 8.17383 16.7903C8.23242 16.8033 8.28776 16.8098 8.33984 16.8098C8.39193 16.8098 8.44727 16.8033 8.50586 16.7903C8.56445 16.7773 8.61979 16.7577 8.67188 16.7317H8.65234C8.70443 16.7187 8.75 16.6991 8.78906 16.6731C8.82812 16.6471 8.86719 16.6145 8.90625 16.5754C8.90625 16.5754 8.9095 16.5722 8.91602 16.5657C8.92253 16.5592 8.92578 16.5559 8.92578 16.5559L9.86328 15.6184C10.0195 15.4752 10.1986 15.358 10.4004 15.2668C10.6022 15.1757 10.8138 15.1301 11.0352 15.1301H15.8398C16.0742 15.1301 16.2728 15.0487 16.4355 14.886C16.5983 14.7232 16.6797 14.5312 16.6797 14.3098V1.80981C16.6797 1.57544 16.5983 1.37687 16.4355 1.21411C16.2728 1.05135 16.0742 0.969971 15.8398 0.969971ZM5.64453 13.47H1.67969V2.63013H6.67969C6.90104 2.63013 7.0931 2.71151 7.25586 2.87427C7.41862 3.03703 7.5 3.2356 7.5 3.46997V14.0364C7.23958 13.8671 6.94987 13.7304 6.63086 13.6262C6.31185 13.5221 5.98307 13.47 5.64453 13.47ZM15 13.47H11.0352C10.7096 13.47 10.3874 13.5188 10.0684 13.6165C9.74935 13.7141 9.45312 13.8541 9.17969 14.0364V3.46997C9.17969 3.2356 9.26107 3.03703 9.42383 2.87427C9.58659 2.71151 9.77865 2.63013 10 2.63013H15V13.47Z"
                                        fill="#697A8D" />
                                </svg>
                                <p>15 заданий</p>
                            </div>
                        </div>
                        <a href="" class="go-to">Перейти →</a>
                    </div>
                </div>
            </div>

            <!--<div class="last-result">-->
            <!--    <h4>Последний результат</h4>-->
            <!--    <div class="last-result-info">-->
            <!--        <img src="assets/images/learning/flash.png" alt="">-->
            <!--        <div class="last-result-text">-->
            <!--            <div class="lsat-result-name">-->
                           
            <!--                <h3>Название задания</h3>-->
            <!--                <p>82%</p>-->
            <!--            </div>-->
            <!--            <a class="go" href="">Перейти</a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
        <div class="progress">
            <h4>Ваш прогресс</h4>
            <?php if(!$purchased): ?>
                <p class="NoLearning">Пока что вы не прошли ни одного урока :(</p>
                <?php endif; ?>
            <?php foreach ($purchased as $pur):
                $course = $database->query("SELECT * FROM `courses` WHERE `id` = " . $pur['courseId'])->fetch(2);
                $lessons = $database->query("SELECT DISTINCT lessons.id, lessons.name FROM `lessons` JOIN `homeworks` ON lessons.id = homeworks.lessonId WHERE `courseId` = " . $course['id'])->fetchAll(2);
                ?>
                <div class="progress-item">
                    <p>Прогресс по курсу
                        <?= $course['name'] ?>
                    </p>
                    <div class="progress-bar">
                        <?php foreach ($lessons as $lesson): ?>
                            <?php
                            $lessonId = $lesson['id'];
                            $statusQuery = $database->query("SELECT status FROM `peoplesAnswers` WHERE `question_id` IN (SELECT questionid FROM `homeworks` WHERE `lessonId` = $lessonId) AND `user_id` = " . $_SESSION['uid'])->fetch();

                            if (isset($statusQuery['status']) && $statusQuery['status'] == 'on_check') {
                                $statusClass = 'yellow-bar';
                            } elseif (isset($statusQuery['status']) && $statusQuery['status'] == 'checked') {
                                $statusClass = 'green-bar';
                            } else {
                                $statusClass = 'gray-bar';
                            }

                            ?>
                            <div class="section <?= $statusClass ?>"></div>

                        <?php endforeach; ?>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>