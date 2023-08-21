// import * as THREE from 'three'
// import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls'

import * as THREE from '/js/three/three.module.js';
import { OrbitControls } from '/js/three/OrbitControls.js';
import { GLTFLoader } from '/js/three/GLTFLoader.js';

class Model1 {
    constructor (options) {
        this.container = options.domElement
        this.width = this.container.offsetWidth
        this.height = this.container.offsetHeight

        // this.camera = new THREE.PerspectiveCamera( 70, this.width / this.height, 0.01, 10 )
        // this.camera.position.z = 1
        
        //
        this.camera = new THREE.PerspectiveCamera(40, this.width / this.height, 1, 5000);
        // this.camera.rotation.y = 45/180*Math.PI;
        this.camera.position.x = 2;
        this.camera.position.y = 0.5;
        this.camera.position.z = 10;
        //

        this.scene = new THREE.Scene()

        // axes
        // this.axesHelper = new THREE.AxesHelper( 5 );
        // this.scene.add( this.axesHelper );
        //
        // lights
        this.light = new THREE.PointLight(0x444444, 10);
        this.light.position.set(0, 300, 500);
        this.scene.add( this.light );

        this.light2 = new THREE.PointLight(0x444444, 10);
        this.light2.position.set(500, 100, 0);
        this.scene.add( this.light2 );

        this.light3 = new THREE.PointLight(0x444444, 10);
        this.light3.position.set(0, 100, -500);
        this.scene.add( this.light3 );

        this.light4 = new THREE.PointLight(0x444444, 10);
        this.light4.position.set(-500, 300, 0);
        this.scene.add( this.light4 );
        //

        this.renderer = new THREE.WebGLRenderer({ 
            antialias: true,
            alpha: true // transparent background
        })
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))

        this.container.appendChild( this.renderer.domElement )

        this.controls = new OrbitControls( this.camera, this.renderer.domElement )
        this.controls.enableZoom = false; // disables zoom on scroll
        this.controls.enablePan = false; // disables move on right click
        this.controls.enableDamping = true; // enables smooth animation on release

        this.time = 0

        this.resize()
        this.addObjects()
        this.setupResize()
        this.render()
    }

    addObjects () {
        this.loader = new GLTFLoader();
        this.loader.load('assets/model1.gltf', (gltf) => {
            gltf.scene.position.set(-0.25, -1.25, -0.5);
            gltf.scene.rotation.set(0, 8.25, 0);

            // if( window.innerWidth < 1023.5 ) {
                // gltf.scene.scale.set(0.5, 0.5, 0.5);
            // }
            // if( window.innerWidth < 767.5 ) {
                // gltf.scene.scale.set(1, 1, 1);
            // }

            this.scene.add(gltf.scene);

            console.log(gltf);
        })
    }

    resize () {
        this.width = this.container.offsetWidth
        this.height = this.container.offsetHeight
        this.renderer.setSize( this.width, this.height )
        this.camera.aspect = this.width / this.height
        this.camera.updateProjectionMatrix()
    }

    setupResize () {
        window.addEventListener('resize', this.resize.bind(this))
    }

    render () {
        this.time += 0.05
        this.renderer.render( this.scene, this.camera )
        this.controls.update(); // update controls to enable damping

        window.requestAnimationFrame(this.render.bind(this))
    }
}
class Model2 {
    constructor (options) {
        this.container = options.domElement
        this.width = this.container.offsetWidth
        this.height = this.container.offsetHeight

        // this.camera = new THREE.PerspectiveCamera( 70, this.width / this.height, 0.01, 10 )
        // this.camera.position.z = 1
        
        //
        this.camera = new THREE.PerspectiveCamera(40, this.width / this.height, 1, 5000);
        this.camera.rotation.y = 45/180*Math.PI;
        this.camera.position.x = 2;
        this.camera.position.y = 0.5;
        this.camera.position.z = 10;
        //

        this.scene = new THREE.Scene()

        //
        // axes
        // this.axesHelper = new THREE.AxesHelper( 5 );
        // this.scene.add( this.axesHelper );
        //
        // lights
        this.light = new THREE.PointLight(0x444444, 10);
        this.light.position.set(0, 300, 500);
        this.scene.add( this.light );

        this.light2 = new THREE.PointLight(0x444444, 10);
        this.light2.position.set(500, 100, 0);
        this.scene.add( this.light2 );

        this.light3 = new THREE.PointLight(0x444444, 10);
        this.light3.position.set(0, 100, -500);
        this.scene.add( this.light3 );

        this.light4 = new THREE.PointLight(0x444444, 10);
        this.light4.position.set(-500, 300, 0);
        this.scene.add( this.light4 );
        //

        this.renderer = new THREE.WebGLRenderer({ 
            antialias: true,
            alpha: true // transparent background
        })
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))

        this.container.appendChild( this.renderer.domElement )

        this.controls = new OrbitControls( this.camera, this.renderer.domElement )
        this.controls.enableZoom = false;
        this.controls.enablePan = false;
        this.controls.enableDamping = true;

        this.time = 0

        this.resize()
        this.addObjects()
        this.setupResize()
        this.render()
    }

    addObjects () {
        this.loader = new GLTFLoader();
        this.loader.load('assets/model3.gltf', (gltf) => {
            gltf.scene.position.set(-0.75, -3, 4.25);
            gltf.scene.rotation.set(0, 2.25, 0);
            gltf.scene.scale.set(0.9, 0.9, 0.9);
            this.scene.add(gltf.scene);

            console.log(gltf);
        })
    }

    resize () {
        this.width = this.container.offsetWidth
        this.height = this.container.offsetHeight
        this.renderer.setSize( this.width, this.height )
        this.camera.aspect = this.width / this.height
        this.camera.updateProjectionMatrix()
    }

    setupResize () {
        window.addEventListener('resize', this.resize.bind(this))
    }

    render () {
        this.time += 0.05;
        this.renderer.render( this.scene, this.camera );
        this.controls.update();

        window.requestAnimationFrame(this.render.bind(this));
    }
}
class Model3 {
    constructor (options) {
        this.container = options.domElement
        this.width = this.container.offsetWidth
        this.height = this.container.offsetHeight

        // this.camera = new THREE.PerspectiveCamera( 70, this.width / this.height, 0.01, 10 )
        // this.camera.position.z = 1
        
        //
        this.camera = new THREE.PerspectiveCamera(40, this.width / this.height, 1, 5000);
        this.camera.rotation.y = 45/180*Math.PI;
        this.camera.position.x = 2;
        this.camera.position.y = 0.5;
        this.camera.position.z = 10;
        //

        this.scene = new THREE.Scene()

        //
        // axes
        // this.axesHelper = new THREE.AxesHelper( 5 );
        // this.scene.add( this.axesHelper );
        //
        // lights
        this.light = new THREE.PointLight(0x777777, 10);
        this.light.position.set(0, 300, 500);
        this.scene.add( this.light );

        this.light2 = new THREE.PointLight(0x888888, 10);
        this.light2.position.set(500, 100, 0);
        this.scene.add( this.light2 );

        this.light3 = new THREE.PointLight(0x777777, 10);
        this.light3.position.set(0, 100, -500);
        this.scene.add( this.light3 );

        this.light4 = new THREE.PointLight(0x888888, 10);
        this.light4.position.set(-500, 300, 0);
        this.scene.add( this.light4 );
        //

        this.renderer = new THREE.WebGLRenderer({ 
            antialias: true,
            alpha: true // transparent background
        })
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))

        this.container.appendChild( this.renderer.domElement )

        this.controls = new OrbitControls( this.camera, this.renderer.domElement );
        this.controls.enableZoom = false;
        this.controls.enablePan = false;
        this.controls.enableDamping = true;

        this.time = 0

        this.resize()
        this.addObjects()
        this.setupResize()
        this.render()
    }

    addObjects () {
        this.loader = new GLTFLoader();
        this.loader.load('assets/model2.gltf', (gltf) => {
            gltf.scene.position.set(0, 0, 0);
            gltf.scene.rotation.set(0.25, -1.1, -0.4);
            gltf.scene.scale.set(0.54, 0.54, 0.54);
            this.scene.add(gltf.scene);

            console.log(gltf);
        })
    }

    resize () {
        this.width = this.container.offsetWidth
        this.height = this.container.offsetHeight
        this.renderer.setSize( this.width, this.height )
        this.camera.aspect = this.width / this.height
        this.camera.updateProjectionMatrix()
    }

    setupResize () {
        window.addEventListener('resize', this.resize.bind(this))
    }

    render () {
        this.time += 0.05
        this.renderer.render( this.scene, this.camera )
        this.controls.update();

        window.requestAnimationFrame(this.render.bind(this))
    }
}

let model1 = new Model1({
    domElement: document.getElementById('model-1')
})
let model2 = new Model2({
    domElement: document.getElementById('model-2')
})
let model3 = new Model3({
    domElement: document.getElementById('model-3')
})