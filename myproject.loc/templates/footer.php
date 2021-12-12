</td>

<td width="300px" class="sidebar">
    <div class="sidebarHeader">Меню</div>
    <ul>
        <li><a href="/">Главная страница</a></li>
        <li><a href="/about-me">Обо мне</a></li>


    </ul>
    <? if (!empty($user) && $user->isAdmin()): ?>
        <div class="sidebarHeader">Админ меню</div>
        <ul>
            <li><a href="/admin">Админка</a></li>
            <li><a href="/articles/add">Написать статью</a></li>
        </ul>
    <? endif; ?>
</td>
</tr>
<tr>
    <td class="footer" colspan="2">Все права защищены (c) <a href="http://www.instagram.com/xdeanboi">@xdeanboi</a></td>
</tr>
</table>

</body>
</html>