const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"dashboard":{"uri":"\/","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"authenticate":{"uri":"authenticate","methods":["POST"]},"ziggy":{"uri":"ziggy","methods":["GET","HEAD"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
