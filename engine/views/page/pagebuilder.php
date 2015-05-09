
<!DOCTYPE html>
<html lang="en">
<head>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<script type='text/javascript'>
      console.log('');
	</script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	
	<script type='text/javascript'>
		

		var serialized_json = JSON.parse('<?=$data['modules']?>');



		
		var serialized = [];
		
		$.each(serialized_json,function(key,value){
		 value.id = key;
		 serialized.push(value);
		 
		});
		
		//design styles
		
		var design_json = JSON.parse('<?=$data['styles']?>');
		
		//add elements style
		$.each(design_json,function(key,val){
							 
			$.each(val,function(key2,val2){
			
			if(key2.search('border-') > -1)
			 val[key2] = '1px solid #'+val2;
			
			if(key2.search('padding-') > -1)
			 val[key2] = val2+'px';
			 
			 
			if(key2 == 'color')
			 val[key2] = '#'+val2;
			 
			if(key2 == 'font-size')
			 val[key2] = val2+'px';
			 
			 
			if(key2 == 'background-color')
			 val[key2] = '#'+val2;
			// console.log(val2);
		 });
							
		});
	   
	    //console.log(serialized);
	</script>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/../engine/external_scripts/gridster/src/gridstack.css"/>


    <script src="http://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.0/jquery-ui.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.5.0/lodash.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/knockout/3.2.0/knockout-min.js"></script>
    <script src="/../engine/external_scripts/gridster/src/gridstack.js"></script>

    <style type="text/css">
        .grid-stack {
            background: #ffffff;
        }

        div.grid-stack-item-content {
            color: #2c3e50;
            text-align: left;
			overflow:auto;
        }
    </style>
</head>
<body>
    <div class="container-fluid">

        <div data-bind="component: {name: 'dashboard-grid', params: $data}"></div>
    </div>


    <script type="text/javascript">

	    
        ko.components.register('dashboard-grid', {
            viewModel: {
                createViewModel: function (controller, componentInfo) {
                    var ViewModel = function (controller, componentInfo) {
                        var grid = null;

                        this.widgets = controller.widgets;

                        this.afterAddWidget = function (items) {
                            if (grid == null) {
                                grid = $(componentInfo.element).find('.grid-stack').gridstack({
                                    auto: false
                                }).data('gridstack');
								
								
                            }

                            var item = _.find(items, function (i) { return i.nodeType == 1 });
                            grid.add_widget(item);
                            ko.utils.domNodeDisposal.addDisposeCallback(item, function () {
                                grid.remove_widget(item);
                            });
                            grid.disable(); //remove dragging and resize
							

							 
							 $(item).css(design_json[$(item).attr('id')]);
						
						};
					
                    };
                 
                    return new ViewModel(controller, componentInfo);
                }
            },
            template:
                [
                    '<div class="grid-stack" data-bind="foreach: {data: widgets, afterRender: afterAddWidget}">',
                    '   <div class="grid-stack-item" data-bind="attr: {\'data-gs-x\': $data.x, \'data-gs-y\': $data.y, \'data-gs-width\': $data.width, \'data-gs-height\': $data.height, \'data-gs-auto-position\': $data.auto_position , \'data-id\':$data.id, \'id_m\':$data.id_m}">',
                    '       <div class="grid-stack-item-content">$data.module.content</div>',
                    '   </div>',
                    '</div> '
                ].join('')
        });

        $(function () {
            var Controller = function (widgets) {
                var self = this;

                this.widgets = ko.observableArray(widgets);

                this.add_new_widget = function () {
                    this.widgets.push({
                        x: 0,
                        y: 0,
                        width: Math.floor(1 + 3 * Math.random()),
                        height: Math.floor(1 + 3 * Math.random()),
                        auto_position: true,
						module:0,
						
                    });
                };
				
				 this.save_grid = function () {
                    this.serialized_data = _.map($('.grid-stack > .grid-stack-item:visible'), function (el) {
                        el = $(el);
                        var node = el.data('_gridstack_node');
                        return {
                            x: node.x,
                            y: node.y,
                            width: node.width,
                            height: node.height,
							module: el.attr('module-id')
                        };
                    }, this);
                    console.log(JSON.stringify(this.serialized_data, null, '    '));
                }.bind(this);

                this.delete_widget = function (item) {
                    self.widgets.remove(item);
                };
            };

            var widgets = serialized;
	
			

            var controller = new Controller(widgets)
            ko.applyBindings(controller);
			
		   //apply css
		   
	
		
        });
    </script>
</body>
</html>
