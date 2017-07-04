<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/4
 * Time: 11:55
 * @author: yfl
 * @QQ: 554665488
 * @description:
 * @time:
 *
 */
/**
 * Session 和 Cookie 有什么关系

    Cookie 也是由于 HTTP 无状态的特点而产生的技术。也被用于保存访问者的身份标识和一些数据。每次客户端发起 HTTP 请求时，会将 Cookie 数据加到 HTTP header 中，提交给服务端。这样服务端就可以根据 Cookie 的内容知道访问者的信息了。

    可以说，Session 和 Cookie 做着相似的事情，只是 Session 是将数据保存在服务端，通过客户端提交来的 session_id 来获取对应的数据；而 Cookie 是将数据保存在客户端，每次发起请求时将数据提交给服务端的。

    上面提到，session_id 可以通过 URL 或 cookie 来传递，由于 URL 的方式比 cookie 的方式更加不安全且使用不方便，所以一般是采用 cookie 来传递 session_id。

    服务端生成 session_id，通过 HTTP 报文发送给客户端（比如浏览器），客户端收到后按指示创建保存着 session_id 的 cookie。cookie 是以 key/value 形式保存的，看上去大概就这个样子的：

    PHPSESSID=e4tqo2ajfbqqia9prm8t83b1f2

在 PHP 中，保存 session_id 的 cookie 名称默认叫作 PHPSESSID，这个名称可以通过 php.ini 中 session.name 来修改，也可以通过函数 session_name() 来修改。
 */

//为什么不推荐使用 PHP 自带的 files 型 Session 处理器
//在 PHP 中，默认的 Session 处理器是 files，处理器可以用户自己实现（参见：自定义会话管理器）。
//我知道的成熟的 Session 处理器还有很多：Redis、Memcached、MongoDB……为什么不推荐使用 PHP 自带的 files 类型处理器，PHP 官方手册中给出过这样一段 Note：
//无论是通过调用函数 session_start() 手动开启会话， 还是使用配置项 session.auto_start 自动开启会话， 对于基于文件的会话数据保存（PHP 的默认行为）而言，
// 在会话开始的时候都会给会话数据文件加锁， 直到 PHP 脚本执行完毕或者显式调用 session_write_close() 来保存会话数据。 在此期间，其他脚本不可以访问同一个会话数据文件。
//为了证明这段话，我们创建一下 2 个文件：
session_start();
$_SESSION['name']='Tom';

var_dump($_SESSION);
session_write_close();  //session_write_close() 就意味着将数据写到文件中并结束当前会话。那么，在后面代码中要使用 Session 时，必须重新调用 session_start()。
sleep(5);

$_SESSION['name']='KeBi';
var_dump($_SESSION);
//session_destroy();
//setcookie('PHPSESSID','asd',1);

//对于大量使用 Ajax 或者并发请求的网站而言，这可能是一个严重的问题。
// 解决这个问题最简单的做法是如果修改了会话中的变量， 那么应该尽快调用 session_write_close() 来保存会话数据并释放文件锁。 还有一种选择就是使用支持并发操作的会话保存管理器来替代文件会话保存管理器
//我推荐的方式是使用 Redis 作为 Session 的处理器。
//Session 数据是什么时候被删除的
/**
 * session.gc_maxlifetime 指定过了多少秒之后数据就会被视为"垃圾"并被清除。 垃圾搜集可能会在 session 启动的时候开始（ 取决于 session.gc_probability 和 session.gc_divisor）。 session.gc_probability 与 session.gc_divisor 合起来用来管理 gc（garbage collection 垃圾回收）进程启动的概率。此概率用 gc_probability/gc_divisor 计算得来。例如 1/100 意味着在每个请求中有 1% 的概率启动 gc 进程。session.gc_probability 默认为 1，session.gc_divisor 默认为 100。

   继续用我上面那个不太恰当的比方吧：如果我们把物品放在超市的储物箱中而不取走，过了很久（比如一个月），那么保安就要清理这些储物箱中的物品了。当然并不是超过期限了保安就一定会来清理，也许他懒，又或者他压根就没有想起来这件事情。
 */
/**
 * 为什么重启浏览器后 Session 数据就取不到了

    session.cookie_lifetime 以秒数指定了发送到浏览器的 cookie 的生命周期。值为 0 表示"直到关闭浏览器"。默认为 0。

    其实，并不是 Session 数据被删除（也有可能是，概率比较小，参见上一节）。只是关闭浏览器时，保存 session_id 的 Cookie 没有了。也就是你弄丢了打开超市储物箱的钥匙（session_id）
 *
 *
 * 同理，浏览器 Cookie 被手动清除或者其他软件清除也会造成这个结果。

    为什么浏览器开着，我很久没有操作就被登出了

    这个是称为“防呆”，为了保护用户账户安全的。

    这个小节放进来，是因为这个功能的实现可能和 Session 的删除机制有关（之所以说是可能，是因为这个功能不一定要借住 Session 实现，用 Cookie 也同样可以实现）。

    说简单一点，就是长时间没有操作，服务端的 Session 文件过期被删除了。
 */
/**
 * 1:设置cookie 的过期时间 为30分钟 并且设置session的lifetime也为30分钟
 *
 * 2：为自己的session添加一个时间time stamp
 *
 * 3：每次访问的时候判断时间戳
 */

/**
 * 为什么不能用memcached存储Session
 * memcached是一个设计用于缓存数据而不是存储数据的系统，因此不应该用于存储Session。
 */