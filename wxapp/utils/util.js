const router = require("./../config/router.js");

const formatTime = date => {
  const year = date.getFullYear()
  const month = date.getMonth() + 1
  const day = date.getDate()
  const hour = date.getHours()
  const minute = date.getMinutes()
  const second = date.getSeconds()

  return [year, month, day].map(formatNumber).join('/') + ' ' + [hour, minute, second].map(formatNumber).join(':')
}

const formatNumber = n => {
  n = n.toString()
  return n[1] ? n : '0' + n
}

const login = (function(){
  wx.login({
    success(result){
      if(!result.code){
        console.log("login error:",result);
        return;
      }
      console.log(result);
    }
  });
})

const httpRequest=(options,callback)=>{
  if(!options || !options.url){
    console.log("Url is Empty",options);
    return;
  }
  let data = options.data? options.data:{};
  let header = options.header?options.header:{};
  if(!header["x-token"]){
    header["x-token"] = wx.getstorage("token");
  }
  wx.showLoading({
    title: '加载中……',
    mask:true
  })
  wx.request({
    url: options.url,
    data:data,
    method:options.method?options.method:"GET",
    header:header,
    dataType:"json",
    success(result){
      console.log(result);
    }
  })
}
module.exports = {
  formatTime: formatTime,
  login: login
}
