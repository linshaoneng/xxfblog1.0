<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>后台管理</title>
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/myblog/Public/Common/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/myblog/Public/Common/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/myblog/Public/Admin/css/base.css" />
    
    
</head>
<body>
    <header>
        <div class="row">
            <nav class="navbar" role="navigation">
                <div class="navbar-header">
                    <div class="navbar-brand">
                        <a href=""><span class="logo">后台管理</span></a>
                    </div>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav user-menu navbar-right">
                        <li>
                            <span href="" class="settings">
                                <span class="fa fa-home"></span>
                                <span class="txt">：<a href="/" target="_blank">网站首页</a></span>
                            </span>
                        </li>
                        <li>
                            <span href="" class="settings">
                                <span class="fa fa-user"></span>
                                <span class="txt">：<?php echo ($admin); ?></span>
                            </span>
                        </li>

                        <li class="last">
                            <a href="<?php echo U('Login/logOut');?>" class="settings" title="退出">
                                <span class="fa fa-ban"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <div id="sidebar" class="sidebar">
        <div class="sidebar-inner">
            <ul class="nav nav-list" id="left-menu">
                <?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li>
                        <?php if($menu['group']['url'] == 'javascript:void(0);'): ?><a href="javascript:void(0);" class="nav-top-item no-submenu">
                                <i class="fa <?php echo ($menu['group']['icon']); ?>"></i>
                                <span class="hidden-minibar"><?php echo ($menu['group']['title']); ?></span>
                            </a>
                        <?php else: ?>
                            <a href="<?php echo (U($menu['group']['url'])); ?>" class="<?php if(!empty($_child)): ?>nav-top-item no-submenu<?php endif; echo ($menu['group']['class']); ?>">
                                <i class="fa <?php echo ($menu['group']['icon']); ?>"></i>
                                <span class="hidden-minibar"><?php echo ($menu['group']['title']); ?></span>
                            </a><?php endif; ?>
                        <?php if(!empty($menu['_child'])): ?><ul <?php if(($menu['group']['class']) == "active"): ?>style="display: block"<?php endif; ?>>
                            <?php if(is_array($menu['_child'])): $i = 0; $__LIST__ = $menu['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><li class="<?php echo ($child['class']); ?>"><a href="<?php echo (U($child['url'])); ?>"><?php echo ($child['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul><?php endif; ?>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <div id="main-content" class="content">
        

    <div class="page-header clearfix">
        <h3>文章管理</h3>
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="<?php echo U('Article/index');?>">文章列表</a>
            </li>
            <li>
                <a href="<?php echo U('Article/add');?>">添加文章</a>
            </li>
        </ul>
    </div>
    <div class="search-content">
        <form action="<?php echo U('Article/index');?>" method="post"class="search-form form-inline" role="form">
            <div class="form-group">
                <label class="sr-only" for="title">请输入文章标题</label>
                <input class="earch-input form-control" id="title" type="text" name="title" value="<?php echo ($request['title']); ?>" placeholder="请输入文章标题"/>　
            </div>
            <button type="submit" class="btn derive">查询</button>　
        </form>
    </div>

    <!--提示 start-->
<div class="alert alert-success alert-dismissible notification success" role="alert" style="display:none">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <div></div>
</div>
<div class="alert alert-danger alert-dismissible notification error n-error" role="alert" style="display:none">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <div></div>
</div>
<!--提示 end-->

    <div class="content-box-content">

        <form action="<?php echo U('Article/remove');?>" method="post" class="batch-form">
            <input type="hidden" name="model" value="Article">
            <table class="table table-striped table-framed table-hover">
                <thead>
                <tr>
                    <th width="6%">
                        <input class="check-all" type="checkbox" />&nbsp;&nbsp;ID
                    </th>
                    <th width="13%">发布时间</th>
                    <th>标题</th>
                    <th>分类</th>
                    <th>作者</th>
                    <th>是否公开</th>
                    <th>是否顶置</th>
                    <th width="6%">操作</th>
                </tr>
                </thead>
                <tbody class="tbody">
                <?php if(empty($list)): ?><tr><td colspan="10"><span style="font-size:14px;">暂无数据</span></td></tr><?php endif; ?>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr>
                        <td>
                            <input type="checkbox" name="id[]" value="<?php echo ($row['id']); ?>"/>&nbsp;&nbsp;<?php echo ($row['id']); ?>
                        </td>
                        <td><?php echo (date('Y-m-d H:i:s',$row['create_time'])); ?></td>
                        <td><?php echo ($row['title']); ?></a></td>
                        <td><?php echo ((isset($row['cate_name']) && ($row['cate_name'] !== ""))?($row['cate_name']):'无分类'); ?></td>
                        <td><?php echo ($row['author']); ?></td>
                        <td>
                            <span class="fa fa-eye on-off fa-black" <?php if($row['status'] == 0): ?>style="display:none;"<?php endif; ?>></span>
                            <input type="hidden" value="Article|status|<?php echo ($row['id']); ?>|1">
                            <span class="fa fa-eye-slash on-off fa-red" <?php if($row['status'] == 1): ?>style="display:none;"<?php endif; ?>></span>
                            <input type="hidden" value="Article|status|<?php echo ($row['id']); ?>|0">
                        </td>
                        <td>
                            <span class="fa fa-eye on-off fa-black" <?php if($row['is_top'] == 0): ?>style="display:none;"<?php endif; ?>></span>
                            <input type="hidden" value="Article|is_top|<?php echo ($row['id']); ?>|1">
                            <span class="fa fa-eye-slash on-off fa-red" <?php if($row['is_top'] == 1): ?>style="display:none;"<?php endif; ?>></span>
                            <input type="hidden" value="Article|is_top|<?php echo ($row['id']); ?>|0">
                        </td>
                        <td>
                            <a href="<?php echo U('Article/update',array('model'=>'Article','alias'=>'art','id'=>$row['id']));?>" title="编辑" class="modify">
                                <span class="fa fa-pencil"></span>
                            </a>&nbsp;
                            <a href="#" title="删除" class="delete-delete">
                                <span class="fa fa-remove"></span>
                            </a><input type="hidden" value="<?php echo U('Article/remove',array('model'=>'Article','id'=>$row['id']));?>">
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>

                <tfoot>
                <tr>
                    <td colspan="20">
                        <div class="bulk-actions fl">
                            <input type="button" class="btn delete-batch" value="批量删除">
                        </div>
                        <div class="fr pagination">
                            <?php echo ($page); ?>
                        </div>
                    </td>
                </tr>
                </tfoot>

            </table>
        </form>
    </div>

    </div>
    <script src="/myblog/Public/Common/js/jquery.min.js"></script>
    <script src="/myblog/Public/Common/js/bootstrap.min.js"></script>
    <script src="/myblog/Public/Admin/js/base.js"></script>
    <script>
        //计算边栏高度
        var sidebarH = $('#main-content').outerHeight();
        if(sidebarH >=768){
            $('#sidebar').css('height',sidebarH);
        }
    </script>
    
</body>
</html>