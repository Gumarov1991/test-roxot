![](https://github.com/Gumarov1991/test-roxot/blob/master/%D0%A1%D0%BD%D0%B8%D0%BC%D0%BE%D0%BA%20%D1%8D%D0%BA%D1%80%D0%B0%D0%BD%D0%B0%20%D0%BE%D1%82%202020-03-10%2019-29-33.png)
# Тестовое задание для junior php разработчика
## ФИО
Гумаров Альберт Сергеевич
## Потраченное на тестовое задание время
3 часа без описания хода действий
## Описание принятых решений:
### Improvement: Добавить иконку мячика, если футболист забил гол
Вначале посмотрел что из себя представляет генерируемая страница. После в общих чертах ознакомился с классами. Ознакомился с json файлом. Нашел, что за действия после определенного типа события отвечает метод processLogs() класса MatchBuilder. Нашел в этом методе обработку события типа 'goal', обратил внимание, что там просто у команды добавляются голы и все, а кто забил не фиксируется. Потом начал добавил методы (public function scoreGoal(): void | public function isScoredGoal(): bool) и свойства (private bool $isScoredGoal;) классу Player. И потом добавил вывод мяча в шаблоне templates/match.html.twig при условии что isScoredGoal === true.
### Improvement: Добавить отображение желтых и красных карточек напротив футболистов, которые получили карточки
В методе processLogs() класса MatchBuilder не было обработки типа события 'yellowCard' и 'redCard', добавил их. В классе Player добавил свойство (private array $cards; // массив в который добавляется цвет карточки) и методы (public function recievedCard(string $typeOfCard): void | public function getCards(): array). Таким образои при событии типа '...Card' вызываем метод recievedCard(string $typeOfCard), который добавляет в массив $this->cards цвет полученной карточки. И после проверяем в шаблоне наличие в свойстве $cards строк 'red' или 'yellow', в зависимости от этого выводим нужную картинку или вообще ничего не выводим, если не обнаружено этих строк.
### Feature: Добавить таблицу с общим временем, проведенным на поле, для каждой позиции
Так как позиции можно отнести именно к классу Team, добавил туда метод (public function getTimeOnFieldPositions(): array), который возвращает массив с позицией и количестом проведенного времени игроками этой позиции. И вывел данные этого массива в шаблоне.
### Bug: Исправить ошибку с подсчетом времени, проведенном на поле
Изучил потестил почему происходит баг, это происходит, потомучто старт матча происходит с 1, а не с 0. Поэтому в методе processLogs() класса MatchBuilder, при условии, что тип события 'startPeriod' изменил значение $minute на 0.
