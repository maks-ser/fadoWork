// import * as THREE from 'three'
// import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls'

import * as THREE from '/wp-content/themes/theme-sp/js/three/three.module.js';
import { OrbitControls } from '/wp-content/themes/theme-sp/js/three/OrbitControls.js';
import { GLTFLoader } from '/wp-content/themes/theme-sp/js/three/GLTFLoader.js';
import { DRACOLoader } from '/wp-content/themes/theme-sp/js/three/DRACOLoader.js';

class Model1 {
    constructor (options) {
        this.container = options.domElement
        this.fadeElement = options.fadeElement

        this.width = this.container.offsetWidth
        this.height = this.container.offsetHeight

        this.camera = new THREE.PerspectiveCamera(40, this.width / this.height, 1, 5000);
        this.camera.rotation.y = 45/180*Math.PI;
        this.camera.position.x = 2;
        this.camera.position.y = 0.5;
        this.camera.position.z = 10;

	    this.scene = new THREE.Scene()

        this.renderer = new THREE.WebGLRenderer({ 
            antialias: true,
            alpha: true
        })
        this.renderer.physicallyCorrectLights = true
        this.renderer.outputEncoding = THREE.sRGBEncoding
        this.renderer.toneMapping = THREE.ReinhardToneMapping
        this.renderer.toneMappingExposure = 3
        this.renderer.shadowMap.enabled = true
        this.renderer.shadowMap.type = THREE.PCFSoftShadowMap
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))

        this.container.appendChild( this.renderer.domElement )

        this.controls = new OrbitControls( this.camera, this.renderer.domElement );
        this.controls.enableZoom = false;
        this.controls.enablePan = false;
        this.controls.enableDamping = true;

        this.time = 0

        this.addLoaders()
        this.resize()
        this.addModel()
        this.addLights()
        this.addEnvironmentMaps()
        this.setupResize()
        this.render()
    }
    
    addLoaders () {
        this.loadingManager = new THREE.LoadingManager();
        this.cubeTextureLoader = new THREE.CubeTextureLoader();
    }

    addModel () {
        const dracoLoader = new DRACOLoader(this.loadingManager)
        dracoLoader.setDecoderPath('/wp-content/themes/theme-sp/assets/draco/')

        const gltfLoader = new GLTFLoader(this.loadingManager)
        gltfLoader.setDRACOLoader(dracoLoader)

        gltfLoader.load('/wp-content/themes/theme-sp/assets/model1.gltf', (gltf) => {
            this.model = gltf.scene
            this.model.position.set(-0.25, -1.25, -0.5)
            this.model.rotation.set(0, 8.25, 0);
            this.scene.add(this.model)
            
            this.updateAllMaterials()
        })
    }
    
    addLights () {
        // ambient
        this.ambientLight = new THREE.AmbientLight(0xffffff, 0.3)
        this.scene.add(this.ambientLight)

        // directional
        this.directionalLight = new THREE.DirectionalLight(0xffffff, 3.5)
        this.scene.add(this.directionalLight)
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
    
    updateAllMaterials () {
        this.scene.traverse((child) =>
        {
            if(child instanceof THREE.Mesh && child.material instanceof THREE.MeshStandardMaterial)
            {
                child.material.envMapIntensity = 0.3
                child.material.needsUpdate = true
                child.castShadow = true
                child.receiveShadow = true
            }
        })
    }

    addEnvironmentMaps () {
        this.environmentMap = this.cubeTextureLoader.load([
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/nx.png',
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/ny.png',
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/nz.png',
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/px.png',
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/py.png',
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/pz.png'
        ])
        this.environmentMap.encoding = THREE.sRGBEncoding
        this.scene.environment = this.environmentMap
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
        this.fadeElement = options.fadeElement

        this.width = this.container.offsetWidth
        this.height = this.container.offsetHeight

        this.camera = new THREE.PerspectiveCamera(40, this.width / this.height, 1, 5000);
        this.camera.rotation.y = 45/180*Math.PI;
        this.camera.position.x = 2;
        this.camera.position.y = 0.5;
        this.camera.position.z = 10;

	    this.scene = new THREE.Scene()

        this.renderer = new THREE.WebGLRenderer({ 
            antialias: true,
            alpha: true
        })
        this.renderer.physicallyCorrectLights = true
        this.renderer.outputEncoding = THREE.sRGBEncoding
        this.renderer.toneMapping = THREE.ReinhardToneMapping
        this.renderer.toneMappingExposure = 3
        this.renderer.shadowMap.enabled = true
        this.renderer.shadowMap.type = THREE.PCFSoftShadowMap
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))

        this.container.appendChild( this.renderer.domElement )

        this.controls = new OrbitControls( this.camera, this.renderer.domElement );
        this.controls.enableZoom = false;
        this.controls.enablePan = false;
        this.controls.enableDamping = true;

        this.time = 0

        this.addLoaders()
        this.resize()
        this.addModel()
        this.addLights()
        this.addEnvironmentMaps()
        this.setupResize()
        this.render()
    }
    
    addLoaders () {
        this.loadingManager = new THREE.LoadingManager();
        this.cubeTextureLoader = new THREE.CubeTextureLoader();
    }

    addModel () {
        const dracoLoader = new DRACOLoader(this.loadingManager)
        dracoLoader.setDecoderPath('/wp-content/themes/theme-sp/assets/draco/')

        const gltfLoader = new GLTFLoader(this.loadingManager)
        gltfLoader.setDRACOLoader(dracoLoader)

        gltfLoader.load('/wp-content/themes/theme-sp/assets/model3.gltf', (gltf) => {
            this.model = gltf.scene
            this.model.position.set(-0.75, -3, 4.25);
            this.model.rotation.set(0, 2.25, 0);
            this.model.scale.set(0.9, 0.9, 0.9);
            this.scene.add(this.model)
            
            this.updateAllMaterials()
        })
    }
    
    addLights () {
        // ambient
        this.ambientLight = new THREE.AmbientLight(0xffffff, 0.3)
        this.scene.add(this.ambientLight)

        // directional
        this.directionalLight = new THREE.DirectionalLight(0xffffff, 3.5)
        this.scene.add(this.directionalLight)
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
     
    updateAllMaterials () {
        this.scene.traverse((child) =>
        {
            if(child instanceof THREE.Mesh && child.material instanceof THREE.MeshStandardMaterial)
            {
                child.material.envMapIntensity = 0.3
                child.material.needsUpdate = true
                child.castShadow = true
                child.receiveShadow = true
            }
        })
    }

    addEnvironmentMaps () {
        this.environmentMap = this.cubeTextureLoader.load([
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/nx.png',
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/ny.png',
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/nz.png',
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/px.png',
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/py.png',
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/pz.png'
        ])
        this.environmentMap.encoding = THREE.sRGBEncoding
        this.scene.environment = this.environmentMap
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
        this.fadeElement = options.fadeElement

        this.width = this.container.offsetWidth
        this.height = this.container.offsetHeight

        this.camera = new THREE.PerspectiveCamera(40, this.width / this.height, 1, 5000);
        this.camera.rotation.y = 45/180*Math.PI;
        this.camera.position.x = 2;
        this.camera.position.y = 0.5;
        this.camera.position.z = 10;

	    this.scene = new THREE.Scene()

        this.renderer = new THREE.WebGLRenderer({ 
            antialias: true,
            alpha: true
        })
        this.renderer.physicallyCorrectLights = true
        this.renderer.outputEncoding = THREE.sRGBEncoding
        this.renderer.toneMapping = THREE.ReinhardToneMapping
        this.renderer.toneMappingExposure = 3
        this.renderer.shadowMap.enabled = true
        this.renderer.shadowMap.type = THREE.PCFSoftShadowMap
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))

        this.container.appendChild( this.renderer.domElement )

        this.controls = new OrbitControls( this.camera, this.renderer.domElement );
        this.controls.enableZoom = false;
        this.controls.enablePan = false;
        this.controls.enableDamping = true;

        this.time = 0

        this.addLoaders()
        this.resize()
        this.addModel()
        this.addLights()
        this.addEnvironmentMaps()
        this.setupResize()
        this.render()
    }

    addLoaders () {
        this.loadingManager = new THREE.LoadingManager();
        this.cubeTextureLoader = new THREE.CubeTextureLoader();
    }

    addModel () {
        const dracoLoader = new DRACOLoader(this.loadingManager)
        dracoLoader.setDecoderPath('/wp-content/themes/theme-sp/assets/draco/')

        const gltfLoader = new GLTFLoader(this.loadingManager)
        gltfLoader.setDRACOLoader(dracoLoader)

        gltfLoader.load('/wp-content/themes/theme-sp/assets/model2.gltf', (gltf) => {
            this.model = gltf.scene
            this.model.position.set(0, 0, 0);
            this.model.rotation.set(0.25, -1.1, -0.4);
            this.model.scale.set(0.54, 0.54, 0.54);
            this.scene.add(this.model)
            
            this.updateAllMaterials()
        })
    }
    
    addLights () {
        // ambient
        this.ambientLight = new THREE.AmbientLight(0xffffff, 1)
        this.scene.add(this.ambientLight)

        // directional
        this.directionalLight = new THREE.DirectionalLight(0xffffff, 7.5) // 10
        this.scene.add(this.directionalLight)
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
    
    updateAllMaterials () {
        this.scene.traverse((child) =>
        {
            if(child instanceof THREE.Mesh && child.material instanceof THREE.MeshStandardMaterial)
            {
                child.material.envMapIntensity = 0.3
                child.material.needsUpdate = true
                child.castShadow = true
                child.receiveShadow = true
            }
        })
    }

    addEnvironmentMaps () {
        this.environmentMap = this.cubeTextureLoader.load([
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/nx.png',
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/ny.png',
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/nz.png',
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/px.png',
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/py.png',
            '/wp-content/themes/theme-sp/assets/textures/environmentMaps/pz.png'
        ])
        this.environmentMap.encoding = THREE.sRGBEncoding
        this.scene.environment = this.environmentMap
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

/*class Model {
 constructor (options) {
 this.src = options.src
 this.container = options.domElement
 this.fadeElement = options.fadeElement

 this.width = this.container.offsetWidth
 this.height = this.container.offsetHeight

 this.camera = new THREE.PerspectiveCamera(40, this.width / this.height, 1, 5000);
 this.camera.rotation.y = 45/180*Math.PI;
 this.camera.position.x = 2;
 this.camera.position.y = 0.5;
 this.camera.position.z = 10;

 this.scene = new THREE.Scene()

 this.renderer = new THREE.WebGLRenderer({
 antialias: true,
 alpha: true
 })
 this.renderer.physicallyCorrectLights = true
 this.renderer.outputEncoding = THREE.sRGBEncoding
 this.renderer.toneMapping = THREE.ReinhardToneMapping
 this.renderer.toneMappingExposure = 3
 this.renderer.shadowMap.enabled = true
 this.renderer.shadowMap.type = THREE.PCFSoftShadowMap
 this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))

 this.container.appendChild( this.renderer.domElement )

 this.controls = new OrbitControls( this.camera, this.renderer.domElement );
 this.controls.enableZoom = false;
 this.controls.enablePan = false;
 this.controls.enableDamping = true;

 this.time = 0

 this.addLoaders()
 this.resize()
 this.addModel()
 this.addLights()
 this.addEnvironmentMaps()
 this.setupResize()
 this.render()
 }

 addLoaders () {
 this.loadingManager = new THREE.LoadingManager();
 this.cubeTextureLoader = new THREE.CubeTextureLoader();
 }

 addModel () {
 const dracoLoader = new DRACOLoader(this.loadingManager)
 dracoLoader.setDecoderPath('/wp-content/themes/theme-sp/assets/draco/')

 const gltfLoader = new GLTFLoader(this.loadingManager)
 gltfLoader.setDRACOLoader(dracoLoader)

 gltfLoader.load(this.src, (gltf) => {
 this.model = gltf.scene
 this.model.position.set(-0.25, -1.25, -0.5)
 this.model.rotation.set(0, 8.25, 0);
 this.scene.add(this.model)

 this.updateAllMaterials()
 })
 }

 addLights () {
 // ambient
 this.ambientLight = new THREE.AmbientLight(0xffffff, 0.3)
 this.scene.add(this.ambientLight)

 // directional
 this.directionalLight = new THREE.DirectionalLight(0xffffff, 3.5)
 this.scene.add(this.directionalLight)
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

 updateAllMaterials () {
 this.scene.traverse((child) =>
 {
 if(child instanceof THREE.Mesh && child.material instanceof THREE.MeshStandardMaterial)
 {
 child.material.envMapIntensity = 0.3
 child.material.needsUpdate = true
 child.castShadow = true
 child.receiveShadow = true
 }
 })
 }

 addEnvironmentMaps () {
 this.environmentMap = this.cubeTextureLoader.load([
 '/wp-content/themes/theme-sp/assets/textures/environmentMaps/nx.png',
 '/wp-content/themes/theme-sp/assets/textures/environmentMaps/ny.png',
 '/wp-content/themes/theme-sp/assets/textures/environmentMaps/nz.png',
 '/wp-content/themes/theme-sp/assets/textures/environmentMaps/px.png',
 '/wp-content/themes/theme-sp/assets/textures/environmentMaps/py.png',
 '/wp-content/themes/theme-sp/assets/textures/environmentMaps/pz.png'
 ])
 this.environmentMap.encoding = THREE.sRGBEncoding
 this.scene.environment = this.environmentMap
 }

 render () {
 this.time += 0.05
 this.renderer.render( this.scene, this.camera )
 this.controls.update();

 window.requestAnimationFrame(this.render.bind(this))
 }
 }
 document.addEventListener('DOMContentLoaded', function () {
    $('.hero-slide__model').each(function () {
        new Model({
            domElement: $(this)[0],
            src: $(this).data('file'),
            // src: '/wp-content/themes/theme-sp/assets/model1.gltf',
        })
    });
});*/
