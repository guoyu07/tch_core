# 前端入口机制

用户访问入口统一,形式为:

  > plugin.php?id=your_plguin_identifier:your_control&op=view

  * id参数: 继承Discuz的id格式,“插件名:功能名”
  * op参数: 动作名

对应代码结构:

  * 插件目录:/root_path/source/plugin/your_plguin_identifier
  * 控制器目录: 插件目录下, include/action/your_control.php,文件名为小写
  * 方法:对应动作名


