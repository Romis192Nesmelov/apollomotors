{{ in_array($car->id, ['55', '56', '25']) ? $item->head : $item->head  .' '.view('issues.blocks.car_name_block', ['car' => $car, 'simple' => false])->render() }}
