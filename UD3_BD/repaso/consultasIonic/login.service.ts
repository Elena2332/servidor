import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Directory, Encoding, Filesystem } from '@capacitor/filesystem';
import { LoadingController, ToastController } from '@ionic/angular';
import {  Network } from '@awesome-cordova-plugins/network/ngx';
import { finalize } from 'rxjs/operators';

const FILE= 'pendientes';

@Injectable({
  providedIn: 'root'
})
export class LoginService {

  id: number;
  usuario: string;
  rol: number;
  avatar: string;
  loggedIn: boolean;

  creando: boolean;
  editado: number;

  subiendo: boolean = false;
  prueba: string;

  constructor(
    private http: HttpClient,
    private loadingCtrl: LoadingController,
    public toastController: ToastController,
    private network: Network
    ) { }



//conexion
  conexion()
  {
    // disconection
    let disconnectSubscription = this.network.onDisconnect().subscribe(() => {
      console.log('network was disconnected :(');
      this.showToast('Sin Conexion','mal');
    });

    // connection
    let connectSubscription = this.network.onConnect().subscribe(() => {
      console.log('network connected!');
      this.showToast('Conectado','bien');
      if(this.rol == 1)
        this.revisarPendientes();  // sube cosas pendientes
    });
  }




/////  Pendientes 
  revisarPendientes() 
  {
    Filesystem.readdir({
      directory: Directory.Data,
      path: ''
    }).then(result => {
      for (let i = 0; i < result.files.length; i++)
      {
        if (result.files[i] == FILE)  //coincide = hay pendientes          
        {
          this.procesarPendientes();
        }
      }
    }); 
  }


  async procesarPendientes()
  {
    if(this.subiendo == false)  
    {
      this.subiendo = true;
      const loading = await this.loadingCtrl.create({
        message: 'Procesando pendientes...'
      });
      await loading.present();
  
      // leer pendientes
      let txt = await Filesystem.readFile({
        directory: Directory.Data,
        path: FILE,        
        encoding: Encoding.UTF8
      });
      
      // introducir lineas
      let lineas = txt.data.split('\n');    // lineas del fichero
      for(let i=0 ; i<lineas.length-1 ; i++)  // ultima linea = undefined
      {
        let datos;
        let lin = lineas[i].split('$'); 

        //introduce Usuarios 
        if(lin[0] == 'addUser')   // lin:=  addUser$ user$ pass$ email$ avatar$ rol
        {
          datos = {
            user: lin[1],
            pass: lin[2],
            email: lin[3],
            avatar: lin[4],
            rol: lin[5]
          };
  
          this.addUsuario(datos).subscribe((res:any)=>{
            
            if(res['status'] == 'Success')
            {
              console.log('usuario pendiente subido');
              this.showToast('creado correctamente desde pendientes','bien');
            }        
            if(res['status'] == 'Error')
            {
              console.log('Error subir usuario pendiente');
              this.showToast('Ha ocurrido un error aniadiendo de pendientes','mal');
            }  
          });
        }
        
        //introduce Imagenes
        if(lin[0] == 'addImg')   // lin:=  (0)addImg$ (1)'file'$ (2)file.name$ (3)file.data
        {
          console.log('SUBIENDO IMG PENDIENTE: '+lin[2]);
          const response = await fetch(lin[3]);
          const blob = await response.blob();
          const formData = new FormData();
          formData.append(lin[1], blob, lin[2]);

          this.subirImg(formData).pipe(
            finalize(() => {
              loading.dismiss();
            })
           ).subscribe(res => {
             if(res['success'])
               console.log('subida bien');
             else             
               console.log('NO subida :)');  
            },(err:any) => {     
              console.log('Error subiendo img pendientes');               
            });  
        } // End if(lin[0] == 'addImg')
      } // End for   
  
      // borrar carpeta  
      Filesystem.deleteFile({
        directory: Directory.Data,
        path: FILE
        
      }).then(result => { 
        this.showToast('pendientes borrado','prueba');
      }, err=>{
        this.showToast('error al borrar pendientes','mal');
        console.log('ERR: '+err);
      }).then(_ => {
      });    
  
      loading.dismiss();
      this.subiendo = false;
    }    
  }


   aniadirPendientes(texto)
  {      
    //aniadir a pendientes
    Filesystem.appendFile({
      data: texto+'\n',
      directory: Directory.Data,
      path: FILE,
      encoding:Encoding.UTF8,
    }).then(result => {
      this.showToast('aniadido a pendientes','prueba');
    }, err=>{
      this.showToast('error al aniadir','prueba');
      console.log(err);
    });
  }




// usuarios
  getTodosUsuarios()
  {
    return this.http.get('http://192.168.1.242/proyectos_elena/ionic/conImg/getAllUsuarios.php');
  }

  getUsuario(ide)
  {    
    return this.http.get('http://192.168.1.242/proyectos_elena/ionic/conImg/getUsuario.php?id='+ide);
  }

  addUsuario(data)
  {
    return this.http.post('http://192.168.1.242/proyectos_elena/ionic/conImg/aniadirUsuario.php', data);
  }

  setUsuario(id,data)
  {
    return this.http.put('http://192.168.1.242/proyectos_elena/ionic/conImg/updateUsuario.php?id='+id, data);
  }

  setPass(id, data)
  {
    return this.http.put('http://192.168.1.242/proyectos_elena/ionic/conImg/updatePass.php?id='+id, data);
  }

  deleteUsuario(ide)
  {
    return this.http.delete('http://192.168.1.242/proyectos_elena/ionic/conImg/deleteUsuario.php?id='+ide);
  }

// email contacto
  enviarEmail(data)
  {
    return this.http.post('http://192.168.1.242/proyectos_elena/ionic/conImg/enviarMail.php', data);
  }


// log
  login(data)
  {
    return this.http.post('http://192.168.1.242/proyectos_elena/ionic/conImg/validarUsuario.php',data);
  }
  logout(ide) 
  {
    localStorage.removeItem('token');
    this.id = undefined;
    this.usuario = undefined;
    this.rol = undefined;
    this.avatar = undefined;
    this.loggedIn = false;
    return this.http.delete('http://192.168.1.242/proyectos_elena/ionic/conImg/logout.php?id='+ide);
  }

// imagenes
  getAll()
  {
    return this.http.get('http://192.168.1.242/proyectos_elena/ionic/conImg/getAllImagenes.php');
  }
  subirImg(formData : FormData)
  {
    return this.http.post('http://192.168.1.242/proyectos_elena/ionic/conImg/upload.php', formData)
  }
  borrarImagen(id)
  {
    return this.http.delete('http://192.168.1.242/proyectos_elena/ionic/conImg/delete.php?id='+id);
  }

// metodos
  isLogged(): boolean
  {
    return this.loggedIn;
  }

  setUser(usu)
  {
    this.usuario = usu;
    this.loggedIn = true;
  }

  toString()
  {
    let log;
    if(this.loggedIn)
      log = ', sesion activa, '
    else
      log = ', no hay sesion, '
    
    return this.usuario+log+ this.rol;
  }



  //  toast
  showToast(mes, tipo) {
    var colo=tipo;
    if(tipo=='bien')
      colo='success'
    if(tipo=='mal')
      colo='danger'
    if(tipo=='prueba')
      colo='medium'

    this.toastController.create({
      message: mes,
      animated: true,
      color: colo,
      duration: 2000,
      position: 'bottom', 
      cssClass: 'my-custom-class',
    }).then((obj) => {
      obj.present();
    });
  }

}
