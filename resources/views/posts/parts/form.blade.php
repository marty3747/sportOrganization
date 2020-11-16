<h5>Дайте мероприятию название</h5>
<div class="form-group">
    <input  name="title" type="text" class="form-control" required value="{{old('title') ?? $post->title ?? ''}}">
</div>

<div class="form-group">
    <label for="exampleFormControlSelect1"><h5>Вид спорта</h5></label>
    <select name="category" class="form-control" id="exampleFormControlSelect1" required value="{{old('category')?? $post->category ?? ''}}">
        <option>Воркаут</option>
        <option>Футбол</option>
        <option>Баскетбол</option>
        <option>Бадминтон</option>
        <option>Теннис</option>
    </select>
</div>

<h5>Введите дату мероприятия</h5>
<div class="form-group">
    <input name="actual" type="datetime-local" class="form-control" required value="{{ old('actual') ?? $post->actual ?? '' }}">
</div>

<h5>Опишите регламент и правила проведения спортивного мероприятия</h5>
<div class="form-group">
    <textarea name="descr" rows="10" class="form-control" required>{{ old('descr') ?? $post->descr ?? '' }}</textarea>
</div>


<body>
<p class="header">Кликните по карте, чтобы узнать адрес проведения мероприятия</p>
<div id="map" style="width: 500px; height: 500px;"></div>
</body>
<p></p>
<h5>Выберете обложку для мероприятия</h5>
<div class="form-group">
    <input type="file" name="img">
</div>
